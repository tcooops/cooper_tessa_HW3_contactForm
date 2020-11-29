import { SendMail } from "./components/mailer.js";

(() => {
    let mailSubmit = document.querySelector('.submit-wrapper'),

    function processMailFailure(result) {
        // show a failure message in the UI
        console.table(result); // table shows us an object in table form
        alert(result.message);

        // show some UI here to let the user know the mail attempt was UNsuccessful

    }

    function processMailSuccess(result) {
        // show a success message in the UI
        console.table(result); // table shows us an object in table form
        alert(result.message);

        // show some UI here to let the user know the mail attempt was successful

    }

    function processMail(event) {
        // block the default submit behaviour
        event.preventDefault();

        // use the SendMail component to try to process mail
        SendMail(this.parentNode) 
            .then(data => processMailSuccess(data))
            .catch(err => processMailFailure(err));

            // the error handler in the catch block could actually be a generic catch and display function that handles every ERROR you may get...
    }

    mailSubmit.addEventListener("click", processMail);
    
})();