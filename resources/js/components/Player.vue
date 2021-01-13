<template>
    <video
        ref="videoPlayer"
        id="my-video"
        class="video-js vjs-big-play-centered"
        controls
        preload="auto"
    >
        <source :src="this.url" :type="this.mimeType" />

        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading to a
            web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank"
            >supports HTML5 video</a
            >
        </p>
    </video>
</template>

<script>
    import videojs from 'video.js';
    import 'videojs-flvjs-es6';
    import zhTW from 'video.js/dist/lang/zh-TW.json';

    export default {
        name: "Player",
        props: [
            'url', 'mimeType'
        ],
        data() {
            return {
                player: null
            }
        },
        mounted() {
            this.player = videojs(this.$refs.videoPlayer, {
                language: 'zh-TW',
                languages: {
                    'zh-TW' : zhTW
                },
                flvjs: {
                    mediaDataSource: {
                        isLive: true,
                        withCredentials: false,
                    },
                },
            })
        },
        beforeDestroy() {
            if (this.player) {
                this.player.dispose()
            }
        }
    }
</script>

<style scoped>
</style>
