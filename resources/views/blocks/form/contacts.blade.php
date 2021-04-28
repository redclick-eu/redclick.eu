<form class="form form_contacts js-form-validate"
      data-action="{{get_rest_url( 0, '/site/v1/callback' )}}"
      data-settings='@json(['headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json']])'>

    <input type="hidden" value="{!! is_404() ? get_home_url() . "/404" : get_permalink() !!}" name="pageUrl">

    <div class="form-block">
        @include('components.input.text', [
            'placeholder' => wpcl_t('Name'),
            'name' => 'name',
            'type' => 'text',
            'checkType' => 'empty'
        ])
    </div>

    <div class="form-block">
        @include('components.input.text', [
            'placeholder' => 'E-mail',
            'name' => 'email',
            'type' => 'email',
            'checkType' => 'email'
        ])
    </div>

    <div class="form-block">
        @include('components.input.text', [
            'placeholder' => wpcl_t('Phone'),
            'name' => 'phone',
            'type' => 'tel',
            'checkType' => 'phone'
        ])
    </div>

    <div class="form-block form-block_full form-block_mm">
        @include('components.input.text', [
            'placeholder' => wpcl_t('Text something...'),
            'name' => 'message',
            'type' => 'textarea',
            'checkType' => '10'
        ])
    </div>

    <div class="form-block form-block_full form-block_nm form-block_inline">
            @include("components.input.checkbox", [
                'name' => 'info',
                'text' => '',
                'value' => 'true',
                'is_checked' => true,
                'is_disabled' => true,
            ])

            <span>
                {!! wpcl_t('I read and agree with') !!}
                <a class="is-link" href="#" data-toggle="#popup_privacyPolicy,body" data-toggle-settings='@json(['types' => ['unique']])'>{!! wpcl_t('privacy policy') !!}</a>.
            </span>
    </div>

    <div class="form-block form-block_full">
        <input type="submit" value="{!! wpcl_t("Send") !!}" class="form-submit g-recaptcha">
    </div>

    <div class="form-backdrop js-backdrop"></div>
</form>
