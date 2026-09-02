<div class="guest-layout">

    <div class="mb-4 text-sm text-gray-600">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form method="POST" action="password-confirm.html">
        <!-- CSRF removed because this is static HTML -->

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="form-label">Password</label>

            <input id="password" type="password" name="password" class="form-input" required
                autocomplete="current-password">

            <!-- Error placeholder -->
            <div class="input-error">
                <!-- Display error message here if needed -->
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="primary-button">
                Confirm
            </button>
        </div>

    </form>

</div>
