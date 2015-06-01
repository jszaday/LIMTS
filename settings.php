<script type="text/javascript">
    var $username,
        $firstName,
        $lastName,
        $dangerAlert,
        $password1,
        $password2;

    var username = '<?php echo $_SESSION[USER_USERNAME] ?>';
    var firstName = '<?php echo $_SESSION[USER_FIRSTNAME] ?>';
    var lastName = '<?php echo $_SESSION[USER_LASTNAME] ?>';

    $(function() {
        $username = $("#username");
        $username.val(username);

        $firstName = $("#first-name");
        $firstName.val(firstName);

        $lastName = $("#last-name");
        $lastName.val(lastName);

        $dangerAlert = $("#danger-alert");
        $password1 = $("#password1");
        $password2 = $("#password2");
    });

    function invalidateControl($control) {
        $control.parents(".form-group").addClass("has-error");
        $control.parents(".form-group").removeClass("has-success");
    }

    function validateControl($control) {
        $control.parents(".form-group").removeClass("has-error");
        $control.parents(".form-group").addClass("has-success");
    }

    function dangerAlert(text) {
        $dangerAlert.html(text).offcanvas("show");
    }

    function validateForm() {
        if (!$username.val() || $username.val().length < 6) {
            dangerAlert("Username must be atleast six characters or longer!");
            invalidateControl($username);
            return false;
        } else {
            validateControl($username);
        }

        if (!$firstName.val()) {
            dangerAlert("First Name cannot be blank!");
            invalidateControl($firstName);
            return false;
        } else {
            validateControl($firstName);
        }

        if (!$lastName.val()) {
            dangerAlert("Last Name cannot be blank!");
            invalidateControl($lastName);
            return false;
        } else {
            validateControl($lastName);
        }

        if (($password1.val() || $password2.val()) && $password1.val().length < 6) {
            dangerAlert("Password must be atleast six characters or longer!");
            invalidateControl($password1);
            invalidateControl($password2);
            return false;
        } else if ($password1.val() != $password2.val()) {
            dangerAlert("Passwords do not match!");
            invalidateControl($password1);
            invalidateControl($password2);
            return false;
        } else if ($password1.val() || $password2.val()) {
            validateControl($password1);
            validateControl($password2);
        }

        return true;
    }

    function onFormSubmitted() {
        if (!validateForm()) {
            return;
        }

        $("#info-alert").html("This page doesn't do anything yet, sorry!").offcanvas("show");
    }
</script>

<div class="alert alert-danger alert-fixed-top offcanvas" id="danger-alert"></div>
<div class="alert alert-info alert-fixed-top offcanvas" id="info-alert"></div>

<h1 id="form-header">User Preferences</h1>
<form action="javascript:onFormSubmitted()" id="mainForm">
    <div class="form-group">
        <label for="manage-name">Change Your Information:</label>

        <div class="well" id="manage-name">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" maxlength="30">
            </div>

        	<div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" class="form-control" id="first-name" name="first-name" maxlength="50">
            </div>

            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" class="form-control" id="last-name" name="last-name" maxlength="50">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Confirm">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="manage-password">Change Your Password:</label>

        <div class="well" id="manage-password">
            <div class="form-group">
                <label for="password1">Password:</label>
                <input type="password" class="form-control" id="password1" name="password1" maxlength="64">
        	</div>

            <div class="form-group">
                <label for="password2">Confirm Password:</label>
                <input type="password" class="form-control" id="password2" name="password2" maxlength="64">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Confirm">
            </div>
        </div>
	</div>
</form>
