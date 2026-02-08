<?php

/**
 * Calcula estadísticas básicas del dashboard
 */
function calculate_dashboard_stats(array $links, array $users): array
{
    $total_links = count($links);
    $total_users = count($users);
    
    $last_user_email = 'N/A';
    if (!empty($users)) {
        $last_user = end($users);
        $last_user_email = $last_user['email'] ?? 'N/A';
    }
    
    return [
        'total_links' => $total_links,
        'total_users' => $total_users,
        'last_user_email' => $last_user_email,
    ];
}
