@if (!empty($successMessage))
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    {{ $successMessage }}
</div>
@endif

@if (session()->has('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif

<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Name_Father') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.Job_Father') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->fatherName }}</td>
                <td>{{ $my_parent->nationalIdFather }}</td>
                <td>{{ $my_parent->passportIdFather }}</td>
                <td>{{ $my_parent->phoneFather }}</td>
                <td>{{ $my_parent->jobFather }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('grades.edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>


                    {{--  <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('grades.delete') }}"><i class="fa fa-trash"></i></button>  --}}

                    <button type="button"
                    class="btn btn-danger btn-sm"
                    data-toggle="modal"
                    data-target="#deleteModal"
                    wire:click="confirmDelete({{ $my_parent->id }})"
                    onclick="setTimeout(() => $('#deleteModal').modal('show'), 200);">
                    <i class="fa fa-trash"></i>
                </button>
                </td>
            </tr>
        @endforeach
    </table>
</div>


   {{-- Delete Form --}}
   <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ trans('classes.deleteClass') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف هذا العنصر؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" wire:click="deleteConfirmed" class="btn btn-danger">حذف</button>
            </div>
        </div>
    </div>
</div>

