<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="english" data-bs-toggle="tab" data-bs-target="#english-pane" type="button"
            role="tab" aria-controls="english-pane" aria-selected="true">English</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="arabic" data-bs-toggle="tab" data-bs-target="#arabic-pane" type="button" role="tab"
            aria-controls="arabic-pane" aria-selected="false">Arabic</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="english-pane" role="tabpanel" aria-labelledby="english" tabindex="0">
        {{ $englishContent }}
    </div>
    <div class="tab-pane fade" id="arabic-pane" role="tabpanel" aria-labelledby="arabic" tabindex="0">
        {{ $arabicContent }}
    </div>

</div>