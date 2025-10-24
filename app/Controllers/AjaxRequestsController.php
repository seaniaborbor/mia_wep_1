<?php 
namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\UsersModel;
use App\Models\NotificationModel;

class AjaxRequestsController extends BaseController
{
    protected $commentModel;
    protected $userModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->userModel = new UsersModel();
        $this->notificationModel = new NotificationModel();
    }

    // In your AjaxRequestsController
public function comment_on_certificate()
{
    // Validate input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'certificate_id' => 'required|numeric',
        'certificate_type' => 'required|in_list[marriage,divorce]',
        'comment_text' => 'required|min_length[5]|max_length[500]',
        'user_id' => 'required|numeric'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return $this->response->setStatusCode(400)->setJSON([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validation->getErrors()
        ]);
    }

    try {
        $data = [
            'certificate_id' => $this->request->getPost('certificate_id'),
            'certificate_type' => $this->request->getPost('certificate_type'),
            'user_id' => $this->request->getPost('user_id'),
            'comment_text' => esc($this->request->getPost('comment_text'))
        ];

       

        $logging_user_id = session()->get('userData')['userId'];
        $logging_accType = session()->get('userData')['userAccountType'];
        $user_branch = session()->get('userData')['userBreanch'];

         $notification_data =  [
            'notification_userId' => $logging_user_id,
            'notification_branch_id' => $user_branch,
            'date_notified' => date('Y-m-d H:i:s')
        ];
   

        if($logging_accType == "ENTRY"){
            $notification_data['ENTRY_VIEW'] = 1;
        }else{
             $notification_data['ENTRY_VIEW'] = 0;
        }

         if($logging_accType == "SIGNA"){
            $notification_data['SIGNA_VIEW'] = 1;
        }else{
            $notification_data['SIGNA_VIEW'] = 0;
        }

         if($logging_accType == "SIGNB"){
            $notification_data['SIGNB_VIEW'] = 1;
        }else{
             $notification_data['SIGNB_VIEW'] = 0;
        }

         if($logging_accType == "SIGNC"){
            $notification_data['SIGNC_VIEW'] = 1;
        }else{
             $notification_data['SIGNC_VIEW'] = 0;
        }
        

    if ($this->commentModel->insert($data)) {
        $notification_data['commentId'] = $this->commentModel->getInsertID();
        if ($this->notificationModel->save($notification_data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Comment and notification added successfully'
        ]);
        } else {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Comment added, but notification failed'
        ]);
        }
    } else {
        return $this->response->setStatusCode(500)->setJSON([
        'status' => 'error',
        'message' => 'Failed to add comment'
        ]);
    }
        
       
        
    } catch (\Exception $e) {
        return $this->response->setStatusCode(500)->setJSON([
            'status' => 'error',
            'message' => 'Server error: ' . $e->getMessage()
        ]);
    }
}


    public function get_comments($certificateType, $certificateId)
    {
        // if (!$this->request->isAJAX()) {
        //     return $this->response->setStatusCode(403)->setJSON([
        //         'status' => 'error',
        //         'message' => 'Forbidden'
        //     ]);
        // }

        try {
            $comments = $this->commentModel
                ->select('certificate_comments.*, login_users.userFullName, login_users.userPicture')
                ->join('login_users', 'login_users.userId = certificate_comments.user_id')
                ->where('certificate_id', $certificateId)
                ->where('certificate_type', $certificateType)
                ->orderBy('created_at', 'DESC')
                ->findAll();

            return $this->response->setJSON([
                'status' => 'success',
                'comments' => $comments
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to fetch comments: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($commentId)
    {
        // if (!$this->request->isAJAX()) {
        //     return $this->response->setStatusCode(403)->setJSON([
        //         'status' => 'error',
        //         'message' => 'Forbidden'
        //     ]);
        // }

        try {
            $comment = $this->commentModel->find($commentId);
            
            if (!$comment) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'Comment not found'
                ]);
            }

            $userId = session()->get('userData')['userId'];
            $isAdmin = session()->get('userData')['userAccountType'] === 'ADMIN';
            
            if ($comment['user_id'] != $userId && !$isAdmin) {
                return $this->response->setStatusCode(403)->setJSON([
                    'status' => 'error',
                    'message' => 'You are not authorized to delete this comment'
                ]);
            }

            $this->commentModel->delete($commentId);
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Comment deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete comment: ' . $e->getMessage()
            ]);
        }
    }




public function user_profile($user_id)
{
    try {
        // Join the user's branch
        $user = $this->userModel
            ->join('branchs_table', 'branchs_table.branchId = login_users.userBreanch')
            ->where('login_users.userId', $user_id)
            ->first();

        // Check if user exists
        if (!$user) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }

        // Remove sensitive fields
        unset($user['password'], $user['reset_token']);

        // Return success response
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $user // ✅ use "data" to match your JS expectations
        ]);

    } catch (\Exception $e) {
        // Return error response on failure
        return $this->response->setStatusCode(500)->setJSON([
            'status' => 'error',
            'message' => 'Failed to fetch user profile: ' . $e->getMessage()
        ]);
    }
}

/* select and show notification for a user logged in 
base on his branch
*/

public function show_notification()
{
    try {
        $userId = session()->get('userData')['userId'];
        $userBranch = session()->get('userData')['userBreanch'];
        $userAccType = session()->get('userData')['userAccountType'];

        $builder = $this->notificationModel->select('notification_table.*, certificate_comments.*, login_users.*')
            ->join("login_users", "login_users.userId = notification_table.notification_userId")
            ->join("certificate_comments", "certificate_comments.comment_id = notification_table.commentId")
            ->where('notification_branch_id', $userBranch);

        // Filter notifications based on account type view
        if ($userAccType == "ENTRY") {
            $builder->where('ENTRY_VIEW', 0);
        } elseif ($userAccType == "SIGNA") {
            $builder->where('SIGNA_VIEW', 0);
        } elseif ($userAccType == "SIGNB") {
            $builder->where('SIGNB_VIEW', 0);
        } elseif ($userAccType == "SIGNC") {
            $builder->where('SIGNC_VIEW', 0);
        }

        $notifications = $builder->orderBy('date_notified', 'DESC')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'notifications' => $notifications
        ]);
    } catch (\Exception $e) {
        return $this->response->setStatusCode(500)->setJSON([
            'status' => 'error',
            'message' => 'Failed to fetch notifications: ' . $e->getMessage()
        ]);
    }
}

// resert notification for a user 
public function mark_notification_as_view($document_id)
{
    try {
        // Get user info from session
        $userAccType = session()->get('userData')['userAccountType'];

        // Get all comment IDs for this certificate
        $commentIds = $this->commentModel
            ->select('comment_id')
            ->where('certificate_id', $document_id)
            ->findColumn('comment_id');

        if (empty($commentIds)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'No comments found for this certificate'
            ]);
        }

        // Prepare update data based on account type
        $updateData = [];
        if ($userAccType == "ENTRY") {
            $updateData['ENTRY_VIEW'] = 1;
        } elseif ($userAccType == "SIGNA") {
            $updateData['SIGNA_VIEW'] = 1;
        } elseif ($userAccType == "SIGNB") {
            $updateData['SIGNB_VIEW'] = 1;
        } elseif ($userAccType == "SIGNC") {
            $updateData['SIGNC_VIEW'] = 1;
        } else {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Unknown account type'
            ]);
        }

        // Update notifications for all found comment IDs
        $this->notificationModel
            ->whereIn('commentId', $commentIds)
            ->set($updateData)
            ->update();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Notifications marked as viewed'
        ]);
    } catch (\Exception $e) {
        return $this->response->setStatusCode(500)->setJSON([
            'status' => 'error',
            'message' => 'Failed to update notifications: ' . $e->getMessage()
        ]);
    }
}

}