<form class="form_contacts">
    <h2 class="form-header">Write to us:</h2>
    <input type="hidden" value="{!! is_404() ? get_home_url()."/404":get_permalink() !!}" name="pageUrl">
    <input type="hidden" value="form" name="use">
    <input type="text" class="form-text form-input" name="name" placeholder="Name">
    <input type="email" class="form-text form-input" name="mail" placeholder="E-mail" pattern="^[-._a-z0-9]+@(?:[a-z0-9][-a-z0-9]+\.)+[a-z]{2,6}$">
    <input type="tel" class="form-text form-input" name="phone" placeholder="Phone" pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$">
    <input type="text" class="form-text form-input" name="text" placeholder="Message">
    <div class="form-privacyPolicy">
        <input type="checkbox" id="contactsCheckbox" checked name="info" class="form-checkbox">
        <label for="contactsCheckbox"></label>
        <span>I have read and agree to the terms of <span class="form-link" data-toggle="#privacyPolicy, #backdrop">the privacy policy</span>.</span>
    </div>
    <input type="submit" value="Send" class="form-submit">
</form>

@include('partials.privacyPolicy')