<form method="POST">
    <h1>Register form</h1>
    <div class="formFlex">
        <div>
            <label>
                <p>city</p>
                <input type="text" name="city">
            </label>
            <label>
                <p>zipcode</p>
                <input type="text" name="zipcode">
            </label>
            <label>
                <p>street</p>
                <input type="text" name="street">
            </label>
            <label>
                <p>housenumber</p>
                <input type="text" name="nr">
            </label>
            <label>
                <p>phone</p>
                <input type="text" name="phone">
            </label>
        </div>
        <div>
            <label>
                <p>Firstname</p>
                <input type="text" name="firstname" required>
            </label>
            <label>
                <p>Lastname</p>
                <input type="text" name="lastname" required>
            </label>
            <label>
                <p>Email</p>
                <input type="text" name="email" required>
            </label>
            <label>
                <p>Password</p>
                <input type="password" name="password" required>
            </label>
            <label>
                <p>Repeat password</p>
                <input type="text" name="passwordV" required>
            </label>
            <button type="submit" name="submit">Register!</button>
        </div>
    </div>
</form>
<?php