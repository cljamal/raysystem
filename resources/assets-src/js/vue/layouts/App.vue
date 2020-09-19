<template>
    <div>
        {{ message }}
    </div>
</template>

<script>
    export default{
        el: '#ray-app',
        data : () => {
            return {
                message : 'Hello World'
            }
        }
    }
</script>
