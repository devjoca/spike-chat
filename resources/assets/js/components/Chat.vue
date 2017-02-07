<template>
    <div>
        <div class="panel-body">
            <ul>
                <li v-for="message in messages">
                    {{ message.sender.name }}: {{ message.body }}
                    <hr>
                </li>
            </ul>
        </div>
        <div class="panel-footer">
            <div class="input-group">
                <input v-model="text" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                <span class="input-group-btn">
                    <button class="btn btn-success btn-sm" id="btn-chat" v-on:click="sendMessage">
                        Send
                    </button>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['conversation_id', 'me'],
        data() {
            return { text: '', messages: [], conversation: {} }
        },
        mounted() {
            axios.get(`${Laravel.base}/conversations/${this.conversation_id}/messages`)
                .then(response => {
                    this.messages = response.data;
                });
            Echo.private(`channel.${this.conversation_id}` )
                .listen('MessageWasSend', (e) => {
                    this.messages.push({
                        'sender': e.sender,
                        'body': e.message.body,
                    });
                });
        },
        methods: {
            sendMessage() {
                axios.post(`${Laravel.base}/conversations/${this.conversation_id}/messages`, {
                    'body': this.text,
                });

                this.messages.push({
                    'sender': { name: this.me },
                    'body': this.text,
                });

                this.text = '';
            }
        }
    }
</script>
