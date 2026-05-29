export const getYoutubeId = (url) => {

    const patterns = [

        /youtube\.com\/watch\?v=([^&]+)/,

        /youtu\.be\/([^?]+)/,

        /youtube\.com\/embed\/([^?]+)/,

        /youtube\.com\/shorts\/([^?]+)/,

        /youtube\.com\/live\/([^?]+)/,
    ]

    for (const pattern of patterns) {

        const match = url.match(pattern)

        if (match && match[1]) {

            return match[1]
        }
    }

    return null
}

export const getVimeoId = (url) => {

    const regExp =
        /(?:vimeo\.com\/(?:.*\/)?)(\d+)/

    const match = url.match(regExp)

    return match
        ? match[1]
        : null
}