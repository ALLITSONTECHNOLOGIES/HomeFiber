<?php

/**
 * PHPMailer - PHP email creation and transport class.
 * PHP Version 5.5
 * @package PHPMailer
 * @see https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 * @author Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author Brent R. Matzelle (original founder)
 * @copyright 2012 - 2020 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Get an OAuth2 token from an OAuth2 provider.
 * * Install this script on your server so that it's accessible
 * as [https/http]://<yourdomain>/<folder>/get_oauth_token.php
 * e.g.: http://localhost/phpmailer/get_oauth_token.php
 * * Ensure dependencies are installed with 'composer install'
 * * Set up an app in your Google/Yahoo/Microsoft account
 * * Set the script address as the app's redirect URL
 * If no refresh token is obtained when running this file,
 * revoke access to your app and run the script again.
 */

namespace PHPMailer\PHPMailer;

/**
 * Aliases for League Provider Classes
 * Make sure you have added these to your composer.json and run `composer install`
 * Plenty to choose from here:
 * @see http://oauth2-client.thephpleague.com/providers/thirdparty/
 */
//@see https://github.com/thephpleague/oauth2-google
use League\OAuth2\Client\Provider\Google;
//@see https://packagist.org/packages/hayageek/oauth2-yahoo
use Hayageek\OAuth2\Client\Provider\Yahoo;
//@see https://github.com/stevenmaguire/oauth2-microsoft
use Stevenmaguire\OAuth2\Client\Provider\Microsoft;

if (!isset($_GET['code']) && !isset($_GET['provider'])) {
    ?>
<html>
<body>Select Provider:<br>
<a href='?provider=Google'>Google</a><br>
<a href='?provider=Yahoo'>Yahoo</a><br>
<a href='?provider=Microsoft'>Microsoft/Outlook/Hotmail/Live/Office365</a><br>
 <script>
        document.getElementById("contactForm").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent default submission

            // If form is not valid, do not continue
            if (!this.checkValidity()) {
                this.reportValidity(); // Show browser validation messages
                return;
            }

            const form = this;
            const formData = new FormData(form);

            fetch(form.action, {
                method: form.method,
                body: formData
            })
                .then(response => response.text()) // or .json() based on your PHP output
                .then(data => {
                    // Show success message
                    Swal.fire({
                        title: 'Thank You!',
                        text: 'Your message has been sent successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'custom-confirm-btn'
                        }
                    });

                    form.reset(); // Reset the form
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });
    </script>
    <script>
        function animateCounters() {
            const counters = document.querySelectorAll('.model-counter-box h3');
            counters.forEach(counter => {
                const value = +counter.getAttribute('data-count');
                const isPercent = counter.innerText.includes('%');
                const isMultiply = counter.innerText.includes('×');
                let start = 0;
                const duration = 1500;
                const stepTime = Math.abs(Math.floor(duration / value));
                const timer = setInterval(() => {
                    start += 1;
                    if (start >= value) {
                        start = value;
                        clearInterval(timer);
                    }
                    counter.innerText = isPercent ? `${start}%` : isMultiply ? `${start}×` : `${start}`;
                }, stepTime);
            });
        }

        // Trigger when section is in viewport
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.disconnect(); // Run only once
                }
            });
        });

        observer.observe(document.querySelector('.model-counter-section'));
    </script>
    <div class="floating-buttons">
        <!-- WhatsApp -->
       <a href="https://wa.me/+918925599822" class="whatsapp-btn" target="_blank" title="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>

        <!-- Email -->
        <a href="mailto:sales@homefiber.in" class="email-btn" title="Send Email">
            <i class="fab fa-rocketchat"></i>
        </a>

        <!-- Enquiry Form (Modal trigger) -->
        <button class="enquiry-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal" title="Enquiry">
            <i class="fa fa-envelope"></i>
        </button>
    </div>
    <div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="enquiryForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="enquiryModalLabel">Enquiry Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="enquiryMessage" style="display: none;"></div> <!-- ✅ Add this element -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                    <div class="mb-3">
                        <label for="emailModal" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailModal" name="email" required />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ienet-btn">Send</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const enquiryForm = document.getElementById("enquiryForm");
            const messageBox = document.getElementById("enquiryMessage");

            enquiryForm.addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(enquiryForm);

                fetch("enquiry_mail.php", { // ✅ Use the correct file name
                    method: "POST",
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            messageBox.innerHTML = "Message has been sent successfully.";
                            messageBox.style.display = "block";
                            messageBox.className = "text-success text-center mb-2";

                            enquiryForm.reset();

                            setTimeout(() => {
                                const modalElement = document.getElementById("enquiryModal");
                                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                                modalInstance.hide();
                                messageBox.style.display = "none";
                            }, 2000);
                        } else {
                            messageBox.innerHTML = data;
                            messageBox.style.display = "block";
                            messageBox.className = "text-danger text-center mb-2";
                        }
                    })
                    .catch(error => {
                        messageBox.innerHTML = "Something went wrong. Please try again.";
                        messageBox.style.display = "block";
                        messageBox.className = "text-danger text-center mb-2";
                    });
            });
        });
    </script>
</body>
</html>
    <?php
    exit;
}

require 'vendor/autoload.php';

session_start();

$providerName = '';

if (array_key_exists('provider', $_GET)) {
    $providerName = $_GET['provider'];
    $_SESSION['provider'] = $providerName;
} elseif (array_key_exists('provider', $_SESSION)) {
    $providerName = $_SESSION['provider'];
}
if (!in_array($providerName, ['Google', 'Microsoft', 'Yahoo'])) {
    exit('Only Google, Microsoft and Yahoo OAuth2 providers are currently supported in this script.');
}

//These details are obtained by setting up an app in the Google developer console,
//or whichever provider you're using.
$clientId = 'RANDOMCHARS-----duv1n2.apps.googleusercontent.com';
$clientSecret = 'RANDOMCHARS-----lGyjPcRtvP';

//If this automatic URL doesn't work, set it yourself manually to the URL of this script
$redirectUri = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//$redirectUri = 'http://localhost/PHPMailer/redirect';

$params = [
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
    'accessType' => 'offline'
];

$options = [];
$provider = null;

switch ($providerName) {
    case 'Google':
        $provider = new Google($params);
        $options = [
            'scope' => [
                'https://mail.google.com/'
            ]
        ];
        break;
    case 'Yahoo':
        $provider = new Yahoo($params);
        break;
    case 'Microsoft':
        $provider = new Microsoft($params);
        $options = [
            'scope' => [
                'wl.imap',
                'wl.offline_access'
            ]
        ];
        break;
}

if (null === $provider) {
    exit('Provider missing');
}

if (!isset($_GET['code'])) {
    //If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
    //Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    unset($_SESSION['provider']);
    exit('Invalid state');
} else {
    unset($_SESSION['provider']);
    //Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken(
        'authorization_code',
        [
            'code' => $_GET['code']
        ]
    );
    //Use this to interact with an API on the users behalf
    //Use this to get a new access token if the old one expires
    echo 'Refresh Token: ', $token->getRefreshToken();
}
