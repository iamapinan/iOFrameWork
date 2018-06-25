{include(file='header.tpl')}
<div class="container-fluid content-wrap" id="root">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 align-self-center">
            <div class="jumbotron">
                <h1>Welcome to Product Page</h1>
                {foreach $product item}
                    <li>{$item.name}</li>
                {/foreach}
            </div>
            </div>
    </div>
</div>
{include(file='footer.tpl')}