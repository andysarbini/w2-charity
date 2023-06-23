<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
</div>

@if (isset($key) && isset($model))
    {{ (($key+1) + ($model->currentPage() * $model->perPage()) - $model->perPage()) }}
@endif