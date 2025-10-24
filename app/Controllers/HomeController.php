<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\BranchModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        helper(['text', 'form']);
        $this->branchModel = new BranchModel();
    }
    // load the home page
  public function index(){
    $data = [
        'title' => 'Login',
        'description' => 'Login to your account',
        'keywords' => 'login, authentication, user access',
        'auther' => 'Ministry of Internal Affairs - Liberia',
    ];

    $data['allBranches'] = $this->branchModel->orderBy('branchId', 'DESC')->findAll();


   
    return view('public/index', $data);
    }

public function chat()
{
    // 1. Sanitize IP for cache key
    $ip = $this->request->getIPAddress();
    $ip = str_replace([':', '.'], ['_', '_'], $ip); // Replace reserved chars

    // 2. Rate Limiting (3 requests/minute per sanitized IP)
    $throttler = \Config\Services::throttler();
    if ($throttler->check("mia_{$ip}", 3, MINUTE) === false) {
        return $this->response->setStatusCode(429)->setJSON([
            'response' => 'Please wait 60 seconds before making another request.'
        ]);
    }

    // 3. Validate input
    $message = $this->request->getJSON()->message ?? $this->request->getPost('message');
    if (empty($message)) {
        return $this->response->setStatusCode(400)->setJSON([
            'response' => 'Please enter a valid question.'
        ]);
    }

    // 4. API Request with Exponential Backoff
    $maxRetries = 2;
    $retryDelay = 1; // seconds
    
    for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
        try {
            $client = \Config\Services::curlrequest();
            $response = $client->request('POST', 'https://openrouter.ai/api/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('openrouter.apiKey'),
                    'HTTP-Referer' => base_url(),
                    'X-Title' => 'Liberia MIA Portal',
                    'Content-Type' => 'application/json',
                    'Priority' => 'low'
                ],
                'json' => [
                    'model' => 'anthropic/claude-3-haiku',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "You are an official Liberian Ministry of Internal Affairs AI assistant. Follow these strict guidelines:
                                1. **Response Format**:
                                - First line: Direct answer in <15 words
                                - Bullet points: Required documents (✓), fees ($), processing time (⌛)
                                - Final line: 'Apply in-person at any MIA office'

                                2. **Certificate Specifics**:
                                • Marriage: §14.2 of Liberian Family Law
                                • Divorce: §22.1 of Liberian Judicial Code  
                                • Bachelor/Spinster: MIA Regulation 2021-03

                                3. **Accuracy Requirements**:
                                - Only cite current 2025 fees and procedures
                                - Cross-verify with MIA handbook Chapter 7
                                - Never speculate - say 'Contact MIA' if uncertain

                                4. **Style Rules**:
                                - Use formal Liberian English
                                - No contractions ('cannot' not 'can't')
                                - Prefix with [MIA Official Response]

                                Example response:
                                [MIA Official Response] 
                                Marriage certificates require:
                                ✓ Valid national ID/passport
                                ✓ Notarized single status affidavit  
                                ✓ 2 passport photos (white background)
                                $25 fee | ⌛ 14 working days
                                Apply in-person at any MIA office"
                        ],
                        [
                            'role' => 'user',
                            'content' => $message
                        ]
                    ],
                    'temperature' => 0.3,
                    'max_tokens' => 100
                ],
                'timeout' => 5
            ]);

            $result = json_decode($response->getBody(), true);
            return $this->response->setJSON([
                'response' => $result['choices'][0]['message']['content'] ?? 'No response from API'
            ]);

        } catch (\Exception $e) {
            if (strpos($e->getMessage(), '429') !== false) {
                sleep($retryDelay);
                $retryDelay *= 2; // Exponential backoff
                continue;
            }
            
            // Fallthrough to local responses
            break;
        }
    }

    // 5. Local Response Fallback
    $localResponses = [
        'marriage' => "Marriage Certificates require: (1) Valid ID, (2) Proof of single status, (3) 2 passport photos, (4) \$25 fee. Apply at any MIA office.",
        'divorce' => "Divorce Certificates need: (1) Court decree, (2) Completed form, (3) \$30 fee. Processing takes 21 days after court approval.",
        'bachelor' => "Bachelor Certificates: (1) Valid ID, (2) Sworn affidavit, (3) \$15 fee. Available at all county offices.",
        'spinster' => "Spinster Certificates: (1) Valid ID, (2) Sworn affidavit, (3) \$15 fee. Processed within 7 working days."
    ];

    foreach ($localResponses as $keyword => $response) {
        if (stripos($message, $keyword) !== false) {
            return $this->response->setJSON(['response' => $response]);
        }
    }

    // 6. Final Fallback
    return $this->response->setJSON([
        'response' => "System busy. For immediate help, visit the Ministry of Internal Affairs or call (+231) XXX-XXXX during work hours."
    ]);
}
}
