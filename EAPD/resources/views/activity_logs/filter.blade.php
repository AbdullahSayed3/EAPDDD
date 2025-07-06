<form method="GET" class="row g-3 mb-3">
    <div class="col-md-3">
        <label for="from">{{ awtTrans('من تاريخ') }}</label>
        <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-3">
        <label for="to">{{ awtTrans('إلى تاريخ') }}</label>
        <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary">{{ awtTrans('فلتر') }}</button>
        <a href="{{ route('activity_logs.index') }}" class="btn btn-secondary">{{ awtTrans('إعادة تعيين') }}</a>
    </div>
</form>