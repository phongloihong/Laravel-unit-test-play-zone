<script>
    export default {
        props: ['attribute'],
        data() {
            return {
                editReply: false,
                body: this.attribute.body
            }
        },
        methods: {
            updateReply() {
                axios.patch(`/replies/${this.attribute.id}`, {
                    body: this.body
                }).then(() => {
                    this.editReply = false;
                    flash('updated');
                })
            }
        }
    }
</script>