@php use App\Controllers\App as A @endphp
<ul class="info" id="info-mobile">
    <li class="info-item">
        <a href="tel:{!! App\create_link_phone(A::get_field("phone_number")) !!}" class="info-link info-link_phone">
            {!! A::get_field("phone_number") !!}
        </a>
    </li>
    <li class="info-item">
        <a href="mailto:{!! A::get_field("email_address") !!}" class="info-link info-link_email">{!! A::get_field("email_address") !!}</a>
    </li>
</ul>
