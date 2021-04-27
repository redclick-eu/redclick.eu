@php use App\Controllers\App as A @endphp
<div class="callback wow fadeIn">
    <div class="callback-row">
        <h2 class="callback-title">{!! wpcl_t('Connect us!') !!}</h2>
        <span class="callback-subTitle">{!! wpcl_t('By messenger') !!}:</span>
        <div class="callback-social callback-social_tg">
            <a class="callback-socialBg" href="{{A::get_field('tg_url')}}" target="_blank"><span>{!! wpcl_t('Write to Telegram') !!}</span></a>
        </div>
        <div class="callback-social callback-social_ms">
            <a class="callback-socialBg" href="{{A::get_field('ms_url')}}" target="_blank"><span>{!! wpcl_t('Chat in Messenger') !!}</span></a>
        </div>
        <div class="callback-social callback-social_sk">
            <a class="callback-socialBg" href="{{A::get_field('sk_url')}}" target="_blank"><span>{!! wpcl_t('Connect by Skype') !!}</span></a>
        </div>
        <span class="callback-subTitle">{!! wpcl_t('By e-mail') !!}:</span>
        @include('blocks.form.contacts')
    </div>
</div>
