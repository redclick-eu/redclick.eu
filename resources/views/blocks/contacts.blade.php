@php use App\Controllers\App as A @endphp
<div class="contacts @if(isset($is_blue) && $is_blue) contacts_blue @endif">
    <div class="contacts-container">
        <div class="contacts-row">
            <div class="contacts-info">
                <p class="contacts-item_name"><span itemprop="name">{!! A::get_field("company_name") !!}</span></p>
                <img itemprop="image" style="display:none;" src="{!! App\asset_path("images/contacts/logo_black.svg") !!}" alt="{!! get_bloginfo('name') !!}">
                <meta itemprop="telephone" content="{!! A::get_field("phone_number") !!}">
                <div class="contacts-blocks">
                    <div class="contacts-block">
                        <span class="contacts-item_label">{!! wpcl_t("Company name") !!}:</span>
                        <span class="contacts-item_value">{!! A::get_field("legal_name") !!}</span>
                        <span class="contacts-item_label">{!! wpcl_t("Reg code") !!}:</span>
                        <span class="contacts-item_value">{!! A::get_field("reg_code") !!}</span>
                        <span class="contacts-item_label">{!! wpcl_t("KMKR") !!}:</span>
                        <span class="contacts-item_value">{!! A::get_field("kmkr") !!}</span>
                        <span class="contacts-item_label">{!! wpcl_t("Address") !!}:</span>
                        <span class="contacts-item_value">{!! A::get_field("legal_postindex") !!}, {!! A::get_field("legal_region") !!}, {!! A::get_field("legal_city") !!}, {!! A::get_field("legal_address") !!}</span>
                    </div>
                    <div class="contacts-block">
                        <span class="contacts-item_label">{!! wpcl_t("Phone") !!}:</span>
                        <a href="tel:{!! App\create_link_phone(A::get_field("phone_number")) !!}" class="contacts-item_value">{!! A::get_field("phone_number") !!}</a>
                        <span class="contacts-item_label">{!! wpcl_t("E-mail") !!}:</span>
                        <a href="mailto:{!! A::get_field("email_address") !!}" class="contacts-item_value">{!! A::get_field("email_address") !!}</a>
                        <span class="contacts-item_label">{!! wpcl_t("Working hours") !!}:</span>
                        <span class="contacts-item_value">{!! A::get_field("work_time") !!}</span>
                    </div>
                </div>
            </div>
            <div class="contacts-map">
                <div class="map" id="googleMap" data-initData='{!! $google_maps_data !!}'></div>
            </div>
        </div>
    </div>
</div>
