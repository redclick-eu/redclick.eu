<form class="form_contacts js-form-contacts" action="/" data-ajax="{{get_rest_url( 0, '/redclick/v1/callback' )}}">
    <h2 class="form-header">{!! wpcl_t("Write to us") !!}:</h2>
    <input type="hidden" value="{!! is_404() ? get_home_url()."/404":get_permalink() !!}" name="pageUrl">
    <input type="text" class="form-text form-input" name="name" placeholder="Name" data-val-type="empty">
    <input type="email" class="form-text form-input" name="email" placeholder="E-mail" data-val-type="email">
    <input type="tel" class="form-text form-input" name="phone" placeholder="Phone" data-val-type="phone">
    <input type="text" class="form-text form-input" name="message" placeholder="Message" data-val-type="10">
    <div class="form-privacyPolicy">
        <input type="checkbox" id="contactsCheckbox" checked name="info" class="form-checkbox" data-val-type="bool">
        <label for="contactsCheckbox"></label>
        <span>{!! wpcl_t("I have read and agree to the terms of") !!} <span class="form-link" data-toggle="#privacyPolicy, #backdrop">{!! wpcl_t("the privacy policy") !!}</span>.</span>
    </div>
    <input type="submit" value="Send" class="form-submit  g-recaptcha" disabled="disabled">
    <div class="form-backdrop js-backdrop"><span>{!! wpcl_t("Message was successfully delivered") !!}</span></div>
</form>

@include('partials.privacyPolicy')