# Register-cp
Register with CP Template + Activation

# Setup

## domain
The regsister was tested in localhost under subdomain `create.localhost`.

To change base domain, go to `create > js > register.js : line 8`, change the following line to your desired create base
```js
base_url : 'http://create.localhost',
```

Eg:
```js
base_url : 'http://register.mycpps.pw',
```

## captcha

You have to create and use **Google's reCaptcha v3**, follow instructions here: [Google reCaptcha v3](https://developers.google.com/recaptcha/docs/v3)

Edit reCaptcha **site key** in `create > js > register.js : line 5`
```js
reCAPTCHA_site_key : "Your site key goes here",
```

Also edit it in `create > index.html` in **header** section

## mysql and captcha (server)
Edit your MySQL data and reCaptcha secret key in the php file.

Edit `create > ajax > index.php : line 17 to 25`, to match your credentials.

## activation
To enable account activation, you have to edit email smtp details, and change `create.localhost` domain in php to your domain, so users can activate their account.

# Usage
Visit [create.yourdomain.com](http://create.localhost/) and enjoy your register!
