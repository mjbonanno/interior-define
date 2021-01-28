<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <!-- removed welcome.vue to insert this code -->

                    <div class="m-4">
                                            
                        <!-- add new short url form -->
                        <div>
                            <url-shortener-form v-on:new-url="getUrls()"/>
                        </div>

                        <!-- list urls -->
                        <div class="mt-4">
                            <div>List URLs:</div>

                            <ul>
                                <!-- loop through list of URLS -->
                                <li v-for="(item, index) in urls" :key="index">
                                    <a :href="item.short_url"> {{ item.short_url }} </a>
                                </li>
                            </ul>

                        </div>

                    </div>

                <!-- end edit -->

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import UrlShortenerForm from '../components/UrlShortenerForm'

    export default {
        components: {
            AppLayout,
            UrlShortenerForm
        },
        data() {
            return {
                urls: Array
            }
        },
        methods: {
            getUrls() {
                axios.get('url/all')
                    .then( response => {
                        this.urls = response.data
                    })
                    .catch( error => {
                        console.log( error );
                    })
            }
        },
        created() {
            this.getUrls();
        }
    }
</script>
