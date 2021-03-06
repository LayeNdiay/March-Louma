
    <style>
        /* RED BORDER ON INVALID INPUT */
        .check input:invalid {
            border-color: red;
        }

        /* FLOATING LABEL */
        .label-floating input:not(:placeholder-shown),
        .label-floating textarea:not(:placeholder-shown) {
            padding-top: 1.4rem;
        }
        .label-floating input:not(:placeholder-shown) ~ label,
        .label-floating textarea:not(:placeholder-shown) ~ label {
            font-size: 0.8rem;
            transition: all 0.2s ease-in-out;
            color: #1f9d55;
            opacity: 1;
        }

    </style>

    <div class="card">
        <div class="card-body">
            @if($errors->has('commentable_type'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('commentable_type') }}
                </div>
            @endif
            @if($errors->has('commentable_id'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('commentable_id') }}
                </div>
            @endif
            <form method="POST" action="{{ route('comments.store') }}" class="w-full mx-auto max-w-3xl bg-white shadow p-8 text-gray-700 ">

                <h2 class="w-full my-2 text-3xl font-bold leading-tight my-5">Veullez remplir vos coordonnées avant</h2>
                @csrf
                @honeypot
                <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
                <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

                {{-- Guest commenting --}}
                @if(isset($guest_commenting) and $guest_commenting == true)
            
                    <!-- name field -->
                    <div class="flex flex-wrap mb-6">
                        <div class="relative w-full appearance-none label-floating">
                            <input class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @if($errors->has('guest_name')) is-invalid @endif"
                            id="name" name="guest_name" type="text" placeholder="Votre nom"required>
                            <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                            @lang('comments::comments.enter_your_name_here')
                            </label>
                        </div>
                        @error('guest_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                
                    <!-- email field -->
                    <div class="flex flex-wrap mb-6">
                        <div class="relative w-full appearance-none label-floating">
                            <input class="tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @if($errors->has('guest_email')) is-invalid @endif"
                            id="name" name="guest_email" type="email" placeholder="Votre email"required>
                            <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">
                            @lang('comments::comments.enter_your_email_here')
                            </label>
                        </div>
                        @error('guest_email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif 

                <!-- Message field -->
                <div class="flex flex-wrap mb-6">
                    <div class="relative w-full appearance-none label-floating">
                        <textarea class="autoexpand tracking-wide py-2 px-4 mb-3 leading-relaxed appearance-none block w-full bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500 @if($errors->has('message')) is-invalid @endif"
                            id="message" type="text" name="message" placeholder="Ecrivez votre commentaire ici "></textarea>
                            <label for="message" class="absolute tracking-wide py-2 px-4 mb-4 opacity-0 leading-tight block top-0 left-0 cursor-text">@lang('comments::comments.enter_your_message_here')
                        </label>
                    </div>
                    <!-- <div class="invalid-feedback">
                        @lang('comments::comments.your_message_is_required')
                    </div> -->
                </div>

                <div class="">
                    <button class="w-full shadow bg-teal-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" style="background-color:green;"
                        type="submit">
                        @lang('comments::comments.submit')
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script src="javascript">
        //RED BORDER ON INVALID INPUT
        document.getElementById('contact-me').addEventListener("invalid", function (event) {
            this.classList.add('check');
        }, true);




            // TEXT AREA AUTO EXPAND
        var textarea = document.querySelector('textarea.autoexpand');

        textarea.addEventListener('keydown', autosize);

        function autosize(){
        var el = this;
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding: 1.4rem .2rem .5rem';
            
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
        }

    </script>
</html>


