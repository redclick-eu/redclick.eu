@php use App\Controllers\App as A @endphp
<div class="bcontacts wow fadeIn">
    <div class="bcontacts-row">
        <h2 class="bcontacts-title">{!! wpcl_t('Connect us!') !!}</h2>
        <span class="bcontacts-subTitle">{!! wpcl_t('By messenger') !!}:</span>
        <div class="bcontacts-social bcontacts-social_tg">
            <a class="bcontacts-socialBg" href="{{A::redclick('tg_url')}}" target="_blank"><span>{!! wpcl_t('Write to Telegram') !!}</span></a>
        </div>
        <div class="bcontacts-social bcontacts-social_ms">
            <a class="bcontacts-socialBg" href="{{A::redclick('ms_url')}}" target="_blank"><span>{!! wpcl_t('Chat in Messenger') !!}</span></a>
        </div>
        <div class="bcontacts-social bcontacts-social_sk">
            <a class="bcontacts-socialBg" href="{{A::redclick('sk_url')}}" target="_blank"><span>{!! wpcl_t('Connect by Skype') !!}</span></a>
        </div>
        <span class="bcontacts-subTitle">{!! wpcl_t('By e-mail') !!}:</span>
        @include('partials.form-contacts')
    </div>
</div>
