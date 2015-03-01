<?php session_start();

//unset($_SESSION['data']);
//unset($_SESSION['success']);

require('vendor/autoload.php');
require('config/database.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!--<link rel="stylesheet" href="css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,500,700"/>
    <!--<link rel="stylesheet" href="css/formValidation.css"/>-->
    <link rel="stylesheet" href="css/font-awesome.css"/>
    <link rel="stylesheet" href="css/application.css"/>
    <link rel="stylesheet" href="css/formValidation.css"/>
</head>
<body>

<?php include 'assets/partials/carousel.php'; ?>

<div class="container">

    <?php flash(); ?>

    <div class="row text-center">
        <div class="col-md-4">
            <h2>Trust</h2>

            <p>We are here for you 24/7 and take care of you if things go wrong – Before, during and after your
                vacation, during hurricanes, strikes and snowstorms. We get it right or we make it right. We have
                stability and financial security. </p>
        </div>
        <div class="col-md-4">
            <h2>Knowledge</h2>

            <p>
                We are well traveled and have been through intensive training, which means we match the right vacation
                to each customer. We have local experts in our business on every vacation and destination. We can find
                out everything you need to know.
            </p>
        </div>
        <div class="col-md-4">
            <h2>Value</h2>

            <p>
                We have deals and vacation packages that you won’t get anywhere else. We plan your vacation at no extra
                cost. We won’t be beaten on price through our Best Price Guarantee.
            </p>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12">
            <h1> Our current offers</h1>
        </div>
        <div class="col-md-6 mb-30">OUR SPECIALS <br/> AT THE WORLD FAMOUS GOLDEN NUGGET IN DOWNTOWN LAS VEGAS</div>
        <div class="col-md-6">OUR SPECIALS <br/> AT THE NEWLY REMODELED TROPICANA HOTEL RIGHT ON THE STRIP</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php foreach (Product::all() as $product): ?>
                <div class="col-md-3">
                    <div class="thumbnail text-center">
                        <img src="/images/hotels/<?= $product->id; ?>.jpg" alt="<?= $product->name; ?>">

                        <div class="caption">
                            <h2 class="color-orange">$<?= $product->price; ?></h2>

                            <p><?= $product->name; ?></p>

                            <p><?= $product->description; ?></p>

                            <p>
                                <button type="button" class="btn btn-primary btn-lg" data-name="<?= $product->name ?>"
                                        data-id="<?= $product->id ?>" data-toggle="modal" data-target="#myModal"> Select
                                </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Services</h1>
            <div class="services">
                <p>Ninth Island Travels is a full service agency and offers exclusive travel agency goods and services,
                    including Airfare and Hotel packages. Additional services include assistance with passports, providing
                    access to top-of-the-line equipment and supplies, and a superior offering that includes access to better
                    than average terrain and activities, accommodations, and entertainment. The value added of Ninth Island
                    Travels offering is its knowledge and expertise, competitive rates, and specialty focus on Hawaii to Las
                    Vegas travels , which translates into increased satisfaction for the customer. </p>

                <p>Economic indicators suggest that an increased demand for Luxury travel services exists. Ninth Island
                    Travels can position itself as a niche service provider within the travel and tourism market and offer
                    high quality travel packages for various leisure trips. Ninth Island Travels will serve the increasing
                    Hawaiian travel market as a top quality, full service provider. All suppliers with whom Ninth Island
                    Travels will deal will be top-notch professionals with accomplished backgrounds.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php include 'assets/partials/tabs.php'; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Contact us</h1>

            <p>
                Your questions and comments are important , you can reach us by phone or email because We’ve got
                everything covered for your needs.
            </p>

            <p>
                Phone: 1-800-925-0770 <br/>
                <a href="mailto:sales@ninthislandtravels.com"> sales@ninthislandtravels.com </a>
            </p>
        </div>
    </div>
</div>

<footer>
    <div class="well">
        <div class="container text-center">
            Copyright © 2015
        </div>
    </div>
</footer>


<!-- Modal -->
<?php include 'assets/partials/_form.php'; ?>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="js/bootstrapValidator.min.js"></script>
<!--<script src="js/base.js"></script>-->
<!--<script src="js/helper.js"></script>-->
<!--<script src="js/framework/bootstrap.js"></script>-->
<!--<script src="js/framework/foundation.js"></script>-->
<!--<script src="js/framework/pure.js"></script>-->
<!--<script src="js/framework/semantic.js"></script>-->
<!--<script src="js/framework/uikit.js"></script>-->

<script>
    $(document).ready(function () {

        $('#myModal').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget),
                id = button.data('id'),
                name = button.data('name'),
                modal = $(this)

            modal.find('.modal-title').text(name)
            modal.find('#productId').val(id)
            $('#contactform').bootstrapValidator('resetForm', true);
        });

        $('#contactform').bootstrapValidator({
            container: "popover",
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-close',
                validating: 'fa fa-refresh'
            },
            fields: {
                first_name: {
                    validators: {
                        notEmpty: {
                            message: "You're required to fill in a first name!"
                        },
                        regexp: {
                            regexp: /^[A-Za-z\s.'-]+$/,
                            message: "Alphabetical characters, hyphens and spaces"
                        }
                    }
                },
                middle_name: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your middle name!"
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your last name!"
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your address!"
                        }
                    }
                },
                phone_home: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your phone (home)!"
                        }
                    }
                },
                phone_cell: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your phone (cell)!"
                        }
                    }
                },
                nationality: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your Natinality!"
                        }
                    }
                },
                birthdate_at: {
                    validators: {
                        notEmpty: {
                            message: "You've forgotten to provide your Natinality!"
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "An email address is mandatory."
                        },
                        emailAddress: {
                            message: "This is not a valid email address"
                        }
                    }
                }
            }
        });
    });

</script>
</body >
</html>