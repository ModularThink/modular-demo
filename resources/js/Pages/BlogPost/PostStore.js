import { defineStore } from 'pinia'
import slug from '@resources/js/Utils/slug.js'

export const usePostStore = defineStore('PostStore', {
    state: () => {
        return {
            post: {
                blog_category_id: null,
                blog_author_id: null,

                tags: [],

                title: '',
                content: '',
                image: null,

                meta_tag_title: '',
                meta_tag_description: '',

                published_at: '',

                remove_previous_image: false,

                tagsHasChanged: false
            }
        }
    },

    actions: {
        setPost(post) {
            this.post = post
        },
        initSeoTags() {
            this.post.meta_tag_title = this.post.title.substring(0, 60)
            this.post.meta_tag_description = this.post.content.replace(
                /<\/?[^>]+(>|$)/g,
                ''
            )
        }
    },

    getters: {
        getRemainingChars: (state) => {
            return (key, max) => {
                if (!state.post[key]) return max

                return max - state.post[key].length
            }
        },

        showSeoAlert: (state) => {
            return () => {
                if (
                    state.post.meta_tag_title &&
                    state.post.meta_tag_title.length
                ) {
                    return false
                }

                if (
                    state.post.title.length > 1 &&
                    state.post.content.length > 2
                ) {
                    return false
                }

                return true
            }
        },

        getSlug: (state) => {
            return () => {
                if (!state.post.title) return ''

                return slug(state.post.title)
            }
        }
    }
})
