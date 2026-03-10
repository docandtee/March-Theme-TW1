<?php 
    $title = get_field('title', 'option');
    $copy = get_field('copy', 'option');
?>
<section class="newsletter-footer bg-primary w-full section-p-b section-p-t overflow-hidden" aria-label="Sign up for our newsletter">
    <div class="container">
        <div class="mx-auto max-w-3xl mb-6">
            <?php if( $title ) { echo '<h1 class="text-light mb-3 text-center">' .esc_html( $title ). '</h1>'; } ?>
            <?php if( $copy ) { echo '<div class="text-light text-lg text-center">' .$copy. '</div>'; } ?>
            <form class="js-cm-form my-6 text-center flex flex-wrap justify-center" id="subForm" action="https://www.createsend.com/t/subscribeerror?description=" method="post" data-id="A61C50BEC994754B1D79C5819EC1255C70E8F65A3ACFEAE937A3706387627C53EC4DFFA27A9F8CF537A39785C83B2A6989805D07B76D51C1D7F01D61C551ACB8">
                <label for="fieldName" class="sr-only">Name </label>
                <input id="fieldName" maxlength="200" name="cm-name" placeholder="Name" class="w-full md:w-auto p-2 border-b-1 border-white mx-2 text-white">
                
                <label for="fieldEmail" class="sr-only">Email </label>
                <input autocomplete="Email" class="w-full md:w-auto js-cm-email-input qa-input-email p-2 border-b-1 border-white mx-2 text-white" id="fieldEmail" maxlength="200" name="cm-mtihk-mtihk" required="" type="email" placeholder="Email address">
                
                <button type="submit" class="mt-3 md:mt-0 w-full md:w-auto py-3 px-5 font-display bg-secondary uppercase hover:bg-primary border-secondary text-dark rounded-full !no-underline mx-2 transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none">Subscribe</button>
            </form>
            <script type="text/javascript" src="https://js.createsend1.com/javascript/copypastesubscribeformlogic.js"></script>

            <p class="text-sm text-light text-center">You are agreeing to receive updates, promotional offers and other messages from Shambala Festival. You may unsubscribe at any time. For more information read our privacy statement.</p>
        </div>
    </div>
</section>