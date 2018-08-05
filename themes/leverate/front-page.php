<?php
/**
 * Template name: Front page
 *
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

               <!-- First row -->
        <div class="row">
            <div class="col-xs 12 col-md-12">
                <!-- Main page title tag -->
                <h1 class="text">For this task test - i use simple Front page</h1>
                <!-- end of title tag-->
            </div>
        </div>
        <!-- end of first row-->

        <div class="row">
            <div class="col-xs-12 col-md-12">
                <form class="myForm" method="post">
                    <fieldset>
                        <label id="labelemail" for="email">Error in email</label>
                        <input type="email" id="email" name="email" required>
                    </fieldset>
                    <fieldset>
                        <label id="labelpass" for="password">Error in password</label>
                        <input type="password" id="password" name="password" required>
                    </fieldset>

                    <fieldset>
                        <div class="check" id="check">
                            <label for="submit">Check your fields !</label>
                            <input type="submit" value="Start" id="submit" name="submit">
                        </div>
                    </fieldset>


                </form>
            </div>


        </div>

        <script>
            $(document).ready( function(){

                console.log('Sharon inner level');

                $('#check').mouseover(function(){
                    console.log('start check');
                    $(this).addClass('redbackground');

                    var email;
                    var pass;

                    email = $('#email').val();
                    pass = $('input:password').val();



                    console.log('email ' + email);
                    console.log('pass ' + pass);

                    if ( email >= 0) {
                        $('#labelemail').show();
                        console.log('empty email');
                    }
                    else {
                        $('#labelemail').hide();
                        console.log('email ok');


                        var email = $('#email').val();

                        if (email.length > 0
                            && (email.match(/.+?\@.+/g) || []).length !== 1) {
                            console.log('invalid');
                            alert('Your email field is invalid, check your e-mail!');
                            $('#submit').attr('disabled','disabled');
                        } else {
                            console.log('valid');
                            //alert('e-mail is ok!');

                            $('#submit').removeAttr('disabled');
                            $(this).removeClass('redbackground');

                        }
                    }
                });



                $('#submit').on('click', function(e){
                    e.preventDefault();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                    if ( email >= 0) {
                        alert ("Email empty");
                        $('#labelemail').show();
                        console.log('empty email');
                        $('#submit').attr('disabled','disabled');
                    }
                    else {
                        $('#labelemail').hide();
                        $('#submit').removeAttr('disabled');
                        alert ("Email ready start Ajax");
                        var postFields = {
                            "email" : email,
                            "password": password,
                        };
                        console.log('pf ' , postFields);
                        $.ajax({
                            url: ajaxurl + "?action=datasend",
                            type: 'POST',
                            data: postFields,
                            success: function(data) {
                                if( data.success == true) alert('Message already sent' );
                                document.location='/tahnkyoupage';
                            },
                            error: function(data) {
                                alert('Failed');
                            }
                        });
                    }
                });

                $('#check').mouseout(function(){
                    $('#submit').removeAttr('disabled');
                    console.log('out');
                });



            });
        </script>



    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
