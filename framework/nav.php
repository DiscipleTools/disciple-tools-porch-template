<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Porch</li>
            <li>
                <a href="#">Drop Example</a>
                <ul class="menu vertical">
                    <li><a href="#">Projects</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                </ul>
            </li>
            <li><a href="/">Home</a></li>

            <li><a href="/porch/profile">Profile</a></li>
            <li><a href="/contacts">Contacts</a></li>
            <li><a href="/settings">Settings</a></li>
            <li><a href="/wp-admin">Admin</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/wp-login.php?action=logout&_wpnonce=<?php echo wp_create_nonce()?>">Logout</a></li>

        </ul>
    </div>
    <div class="top-bar-right">
        <button type="button" class="menu-icon"  data-toggle="offCanvas"></button>
    </div>
</div>

<div class="off-canvas-wrapper">
    <div class="off-canvas position-right" id="offCanvas" data-off-canvas>
        <!-- Your menu or Off-canvas content goes here -->
        <button class="close-button" aria-label="Close menu" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="off-canvas-content" data-off-canvas-content>
        <!-- Your page content lives here -->
    </div>
</div>