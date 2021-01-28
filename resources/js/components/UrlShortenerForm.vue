<template>

    <!-- I am not a big fan of inertia -->
    <!-- But I am using built in inertia components to save on time -->
    
    <jet-form-section @submitted="createShortenedUrl">
        <template #title>
            Url Shortener
        </template>

        <template #description>
            Create a new shortened URL
        </template>

        <template #form>

            <!-- URL -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="url" value="Url" />
                <jet-input id="url" dusk="url-input" type="url" class="mt-1 block w-full" v-model="url" autocomplete="url" />
            </div>
            
            <div>
                {{ creationMsg }}
            </div>
        </template>

        

        <template #actions>
            <jet-button dusk="create-url">
                Create
            </jet-button>
        </template>

    </jet-form-section>
    
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },


        data() {
            return {
                url: '',
                creationMsg: ''
            }
        },
        watch: {
            creationMsg(newVal, oldVal){
                let vm = this;
                //after a creation message is desplayed, remove it after 3 seconds
                setTimeout(function(){ vm.creationMsg = ""; }, 3000);
            }
        },
        methods: {
            createShortenedUrl() {

                axios.post('/url/create', {
                    url: this.url
                })
                .then( response =>{
                    if( response.data.status ) {
                        this.$emit('new-url')
                        this.url = '';
                        this.creationMsg = response.data.msg;
                    } else {
                        console.log(response.data.msg)
                        this.creationMsg = response.data.msg;
                    }
                })
                .catch( error => {
                    console.log( error );
                })
            },
        },
    }
</script>
