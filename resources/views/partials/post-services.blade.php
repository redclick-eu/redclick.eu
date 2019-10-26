@include("partials.title", ["text" => $post_vars['title']])

<div class="post_services">
    <div class="post-row">
        <div class="post-content">
            {!! $post_vars['content'] !!}
        </div>
        <div class="post-info">
            <div class="post-card post-card_cost">
                <h6>Cost</h6>
                <span>{!! $post_vars['cost'] !!}</span> <span>€</span>
            </div>
            <div class="post-card post-card_deadline">
                <h6>Duration of work</h6>
                <span>for {!! $post_vars['deadline'] !!} days</span>
            </div>
        </div>
        <div class="post-form">
            @include("partials.form-contacts")
        </div>
    </div>
</div>