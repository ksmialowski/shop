<ul class="list-unstyled text-light footer-link-list">
    @foreach($products as $product)
        <li><a class="text-decoration-none" href="#">{{ $product->product_name }}</a></li>
    @endforeach
</ul>
