@php use App\Controllers\App as A @endphp
<div class="contacts">
    <div class="contacts-row">
        <div class="contacts-info">
            <p class="contacts-item_name"><span itemprop="name">{!! A::redclick("company_name") !!}</span></p>
            <img itemprop="image" style="display:none;" src="<?= App\asset_path("images/Logo_black.svg"); ?>" alt="{!! get_bloginfo('name') !!}">
            <meta itemprop="telephone" content="{!! A::redclick("phone_number") !!}">
            <div class="contacts-blocks">
                <div class="contacts-block">
                    <span class="contacts-item_label">{!! wpcl_t("Company name") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("company_name") !!}</span>
                    <span class="contacts-item_label">{!! wpcl_t("Reg code") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("reg_code") !!}</span>
                    <span class="contacts-item_label">{!! wpcl_t("KMKR") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("kmkr") !!}</span>
                    <span class="contacts-item_label">{!! wpcl_t("Address") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("legal_region") !!}, {!! A::redclick("legal_address") !!}</span>
                </div>
                <div class="contacts-block">
                    <span class="contacts-item_label">{!! wpcl_t("Phone") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("phone_number") !!}</span>
                    <span class="contacts-item_label">{!! wpcl_t("E-mail") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("email_address") !!}</span>
                    <span class="contacts-item_label">{!! wpcl_t("Working hours") !!}:</span>
                    <span class="contacts-item_value">{!! A::redclick("work_time") !!}</span>
                </div>
            </div>
        </div>
        <div class="contacts-form">
            @include('partials.form-contacts')
        </div>
    </div>
</div>