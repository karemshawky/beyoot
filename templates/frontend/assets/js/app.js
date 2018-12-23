/**
 * @return {!Object} The FirebaseUI config.
 */
function getUiConfig() {
    return {
      'callbacks': {
        // Called when the user has been successfully signed in.
        'signInSuccess': function(user, credential, redirectUrl) {

          var url = '/beyoot/user/login';
          //var url = 'http://beyoot.4art-studio.com/user/login';
          var form = $('<form action="' + url + '" method="post">' +
            '<input type="text" name="phone" value="' + user['phoneNumber'] + '" />' +
            '</form>');
          $('body').append(form);
          form.submit();

          // Do not redirect.
          return false;
        }

      },
      // Opens IDP Providers sign-in flow in a popup.
      'signInFlow': 'popup',
      'signInOptions': [
        // The Provider you need for your app. We need the Phone Auth
        firebase.auth.TwitterAuthProvider.PROVIDER_ID,
        {
          provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
          recaptchaParameters: {
            type: 'image', // another option is 'audio'
            size: 'invisible', // other options are 'normal' or 'compact'
            badge: 'bottomleft' // 'bottomright' or 'inline' applies to invisible.
          },
          defaultCountry: 'EG', // Set default country to the United Kingdom (+44).
          // For prefilling the national number, set defaultNationNumber.
          // This will only be observed if only phone Auth provider is used since
          // for multiple providers, the NASCAR screen will always render first
          // with a 'sign in with phone number' button.
          defaultNationalNumber: '1234567890',
          // You can also pass the full phone number string instead of the
          // 'defaultCountry' and 'defaultNationalNumber'. However, in this case,
          // the first country ID that matches the country code will be used to
          // populate the country selector. So for countries that share the same
          // country code, the selected country may not be the expected one.
          // In that case, pass the 'defaultCountry' instead to ensure the exact
          // country is selected. The 'defaultCountry' and 'defaultNationaNumber'
          // will always have higher priority than 'loginHint' which will be ignored
          // in their favor. In this case, the default country will be 'GB' even
          // though 'loginHint' specified the country code as '+1'.
          loginHint: '+11234567890'
        }
      ],
      // Terms of service url.
      'tosUrl': 'https://www.google.com'
    };
  }
  
  // Initialize the FirebaseUI Widget using Firebase.
  var ui = new firebaseui.auth.AuthUI(firebase.auth());
  
  /**
   * Displays the UI for a signed in user.
   * @param {!firebase.User} user
   */
  var handleSignedInUser = function(user) {
    document.getElementById('user-signed-in').style.display = 'block';
    document.getElementById('user-signed-out').style.display = 'none';
    document.getElementById('name').textContent = user.displayName;
    document.getElementById('email').textContent = user.email;
    document.getElementById('phone').textContent = user.phoneNumber;
    if (user.photoURL){
      document.getElementById('photo').src = user.photoURL;
      document.getElementById('photo').style.display = 'block';
    } else {
      document.getElementById('photo').style.display = 'none';
    }
  };
  
  
  /**
   * Displays the UI for a signed out user.
   */
  var handleSignedOutUser = function() {
    document.getElementById('user-signed-in').style.display = 'none';
    document.getElementById('user-signed-out').style.display = 'block';
    ui.start('#firebaseui-container', getUiConfig());
  };
  
  // Listen to change in auth state so it displays the correct UI for when
  // the user is signed in or not.
  firebase.auth().onAuthStateChanged(function(user) {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('loaded').style.display = 'block';
    handleSignedOutUser();
  });
  
  /**
   * Deletes the user's account.
   */
  var deleteAccount = function() {
    firebase.auth().currentUser.delete().catch(function(error) {
      if (error.code == 'auth/requires-recent-login') {
        // The user's credential is too old. She needs to sign in again.
        firebase.auth().signOut().then(function() {
          // The timeout allows the message to be displayed after the UI has
          // changed to the signed out state.
          setTimeout(function() {
            alert('Please sign in again to delete your account.');
          }, 1);
        });
      }
    });
  };
  
  /**
   * Initializes the app.
   */
  var initApp = function() {
    // document.getElementById('sign-out').addEventListener('click', function() {
    //   firebase.auth().signOut();
    // });
    // document.getElementById('delete-account').addEventListener(
    //     'click', function() {
    //       deleteAccount();
    //     });
  };
  
  window.addEventListener('load', initApp);