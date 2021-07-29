<?php
$user = get_userdata( get_current_user_id() );
if ( empty( $user ) ) {
    echo 'Your not a user!';
    die();
}
?>
<div style="max-width:600px; margin: 0 auto;">
    <h1 class="center">Profile</h1>
    <table>
        <tbody>
            <tr>
                <td>User ID</td>
                <td><?php echo esc_attr( $user->ID ) ?></td>
            </tr>
            <tr>
                <td>User Display Name</td>
                <td><?php echo esc_attr( $user->display_name ) ?></td>
            </tr>
            <tr>
                <td>User Email</td>
                <td><?php echo esc_attr( $user->user_email ) ?></td>
            </tr>
            <tr>
                <td>Checking API</td>
                <td id="api-check"><span class="loading-spinner active"></span></td>
            </tr>
        </tbody>
    </table>
</div>
