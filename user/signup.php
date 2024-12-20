<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css" />
    <link rel="stylesheet" href="signin.css">
  </head>
  <body>
    <a href="/"
      ><img
        class="logo"
        src="./assets/amazon_logo_dark.png"
        alt=""
        width="100px"
    /></a>
    <div class="signin-container">
      <h1 class="signin-title">Sign up</h1>
      <h5 class="input-lable">Your name</h5>
      <input type="text" placeholder="First and last name" />
      <h5 class="input-lable">Mobile number or email</h5>
      <input type="text" />
      <h5 class="input-lable">Password</h5>
      <input type="text" placeholder="At least 6 characters" />
      <h5 class="input-lable">Re-enter password</h5>
      <input type="text" />
      <button>Continue</button>
      <p class="signin-condition">
        By continuing, you agree to Amazon's <span>Conditions of Use</span> and
        <span>Privacy Notice</span>.
      </p>
      <p class="signin-help">&#9656 <span>Need help</span></p>
      <hr>
      <h4>Buying for work?</h4>
      <p class="signin-business"><span>Shop on Amazon Business</span></p>
    </div>
    <div class="signin-bottom">
      <hr>
      <p>Have an account?</p>
      <hr>
    </div>
    <a href="/signin.html"><button class="signin-signup-btn">Login with Amazon account</button></a>
    <footer>
      <div class="footer-link">
        <a href="#">Conditions of Use</a>
        <a href="#">Privacy Notice</a>
        <a href="#">Help</a>
      </div>
      <p class="footer-copyright">© 1996-2024, Amazon.com, Inc. or its affiliates</p>
    </footer>
  </body>
</html>