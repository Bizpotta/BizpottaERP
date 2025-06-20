
@if(isset($call))
{{ Form::model($call, array('route' => array('deals.calls.update', $deal->id, $call->id), 'method' => 'PUT','class'=>'needs-validation','novalidate')) }}
@else
{{ Form::open(array('route' => ['deals.calls.store',$deal->id],'class'=>'needs-validation','novalidate')) }}
@endif
<div class="modal-body">
    <div class="text-end">
        @if (module_is_active('AIAssistant'))
            @include('aiassistant::ai.generate_ai_btn',['template_module' => 'deal_call','module'=>'Lead'])
        @endif
    </div>
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'),['class'=>'form-label']) }} <x-required></x-required>
            {{ Form::text('subject', null, array('class' => 'form-control','required'=>'required','placeholder' => __('Enter Subject'))) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('call_type', __('Call Type'),['class'=>'form-label']) }} <x-required></x-required>
            <select name="call_type" id="call_type" class="form-control" required>
                <option value="outbound" @if(isset($call->call_type) && $call->call_type == 'outbound') selected @endif>{{__('Outbound')}}</option>
                <option value="inbound" @if(isset($call->call_type) && $call->call_type == 'inbound') selected @endif>{{__('Inbound')}}</option>
            </select>
        </div>
        <div class="col-12 form-group">
            {{ Form::label('duration', __('Duration'),['class'=>'form-label']) }} <small class="font-weight-bold">{{ __(' (Format h:m:s i.e 00:35:20 means 35 Minutes and 20 Sec)') }}</small> <x-required></x-required>
            {{ Form::time('duration', null, array('class' => 'form-control','placeholder'=>'00:35:20','step' => '2','required'=>'required')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('user_id', __('Assignee'),['class'=>'form-label']) }} <x-required></x-required>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->getDealUser->id }}" @if(isset($call->user_id) && $call->user_id == $user->getDealUser->id) selected @endif>{{ $user->getDealUser->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 form-group">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', null, array('class' => 'form-control','rows'=>3,'placeholder'=>'Enter Description')) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('call_result', __('Call Result'),['class'=>'form-label']) }}
            {{ Form::textarea('call_result',null, array('class' => 'form-control summernote' , 'id' => 'deal-call-summernote')) }}
        </div>
    </div>
</div>
<div class="modal-footer">
<button type="button" class="btn  btn-light" data-bs-dismiss="modal">{{__('Cancel')}}</button>
 @if(isset($call))
     <button type="submit" class="btn  btn-primary">{{__('Update')}}</button>
 @else
    <button type="submit" class="btn  btn-primary">{{__('Create')}}</button>
 @endif
</div>

{{ Form::close() }}
<script>
    if ($(".summernote").length > 0) {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                ['list', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'unlink']],
            ],
            height: 200,
        });
    }
</script>
