@php use App\Controllers\App as A @endphp
<div class="privacyPolicy" id="privacyPolicy">
    <h4 class="privacyPolicy-header">{!! wpcl_t("Privacy policy") !!}</h4>
    <div class="privacyPolicy-close" data-toggle="#privacyPolicy, #backdrop" data-toggle-type="close"></div>
    <div class="privacyPolicy-content">
        <div class="privacyPolicy-scroll">
            {!! $privacy_policy_content !!}
        </div>
    </div>
</div>