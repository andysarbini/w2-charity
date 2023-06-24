<div class="d-flex justify-content-between mt-3">
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->

    <p>Menampilkan {{ $model->firstItem() }} s/d {{ $model->lastItem() }} dari {{ $model->total() }} entri</p>
    {{ $model->links('pagination::bootstrap-4') }}
</div>