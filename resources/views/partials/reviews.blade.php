@include("partials.title", ["text" => "Reviews"])
<div class="reviews siema-carousel">
    <div class="reviews-row">
        <div class="reviews-arrow reviews-arrow_left siema-arrow_left"></div>
        <div class="reviews-carousel siema-inner">
            @for($i = 0; $i < 4; $i++)
                <div class="reviews-item">
                    <div class="reviews-photo">
                        <img src="http://via.placeholder.com/500x500?text={!! $i+1 !!}" alt="">
                    </div>
                    <div class="reviews-texts">
                        <p class="reviews-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur explicabo illum quae quia quisquam ratione saepe? A alias architecto aut blanditiis cumque deserunt dolorem enim excepturi facilis fuga in iusto laboriosam laborum magni nobis officiis optio perferendis quas quis quisquam recusandae repellendus sequi sunt tempora, totam unde ut. Animi asperiores at aut cumque debitis ea explicabo illo ipsa labore laboriosam nemo nobis numquam perferendis quae quam quisquam recusandae, reprehenderit, sequi similique tempora temporibus ullam veritatis? Asperiores atque beatae cum dicta dolorem error ex, excepturi fuga harum illo incidunt labore laudantium minus nisi odit optio possimus quam quasi quis recusandae sequi ullam veritatis. Consequatur corporis dolorem doloribus magni pariatur unde. Ab autem dicta fugiat fugit laboriosam officia quasi, ratione reprehenderit sed voluptates? Aliquid, commodi deleniti distinctio dolores
                            earum eos error est illum itaque nobis numquam odio praesentium quidem quod similique sint tempora tempore temporibus ullam ut? Beatae itaque omnis quod?<a href="#" class="reviews-linkToFull">...</a>
                        </p>
                        <div class="reviews-name">Lorem L.M., <a href="#">Company Name</a></div>
                    </div>
                </div>
            @endfor
        </div>
        <div class="reviews-arrow reviews-arrow_right siema-arrow_right"></div>
    </div>
</div>