<?php 

if (!function_exists('getRandomColor')) {
    function getRandomColor() {
        $colors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
            '#5a5c69', '#2e59d9', '#17a673', '#2c9faf', '#dda20a',
            '#be2617', '#858796', '#3756e0', '#0d8f5e', '#1f9db8'
        ];
        return $colors[array_rand($colors)];
    }
}