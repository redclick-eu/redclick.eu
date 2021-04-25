<form class="form js-form-contacts js-form-validate" id="Form"
      data-action="{{get_rest_url( 0, '/site/v1/callback' )}}"
      data-settings='@json(['headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']])'>
    <input type="hidden" value="{!! is_404() ? get_home_url()."/404":get_permalink() !!}" name="pageUrl">
    <div class="form-block">
        <input type="text" class="form-input" name="name" placeholder="{!! wpcl_t('Name') !!}" data-val-type="empty">
    </div>
    <div class="form-block">
        <input type="email" class="form-input" name="email" placeholder="E-mail"  data-val-type="email">
    </div>
    <div class="form-block">
        <input type="tel" class="form-input" name="phone" placeholder="{!! wpcl_t('Phone') !!}" data-val-type="phone">
    </div>
    <div class="form-block form-block_full  form-block_mm">
        <textarea name="message" class="form-input form-input_textarea" placeholder="{!! wpcl_t('Text something...') !!}" data-val-type="10"></textarea>
    </div>
    <div class="form-block form-block_full form-block_nm">
        <div class="form-checkbox"><input disabled type="checkbox" id="contactsCheckbox" checked name="info" class="form-checkboxInput"><label for="contactsCheckbox"></label>{!! wpcl_t('I read and agree with') !!} <span class="form-privacyPolicy" data-toggle="#privacyPolicy, #backdrop" data-target="#PrivacyPolicyWindow">{!! wpcl_t('privacy policy') !!}</span>.</div>
    </div>
    <div class="form-block form-block_full"><input type="submit" value="{!! wpcl_t("Send") !!}" class="form-submit g-recaptcha"></div>
    <div class="form-backdrop js-backdrop"><span>{!! wpcl_t("Message was successfully delivered") !!}</span></div>
</form>
