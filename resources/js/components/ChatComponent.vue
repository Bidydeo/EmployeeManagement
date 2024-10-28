<template>
    <div class="card card-primary card-outline direct-chat direct-chat-primary">
        <div class="card-header">
            <h3 class="card-title">Chat with {{ user.name }}</h3>
            <span
                style="width: 12px; height: 12px; margin-left: 12px"
                :class="isUserOnline ? 'bg-green' : 'bg-red'"
                class="inline-block h-2 w-2 rounded-full"
            ></span>
            <div class="card-tools">
                <span
                    data-toggle="tooltip"
                    title="3 New Messages"
                    class="badge badge-light"
                    >3</span
                >
                <button
                    type="button"
                    class="btn btn-tool"
                    data-widget="collapse"
                >
                    <i class="fas fa-minus"></i>
                </button>
                <button
                    type="button"
                    class="btn btn-tool"
                    data-toggle="tooltip"
                    title="Contacts"
                    data-widget="chat-pane-toggle"
                >
                    <i class="fas fa-comments"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- Conversations are loaded here -->
            <div ref="messageContainer" class="direct-chat-messages">
                <div
                    v-for="message in messages"
                    :key="message.id"
                    :class="{
                        right: message.sender_id === currentUser.id,
                        left: message.sender_id !== currentUser.id,
                    }"
                    class="direct-chat-msg"
                >
                    <div class="direct-chat-infos clearfix">
                        <span
                            class="direct-chat-name"
                            :class="
                                message.sender_id === currentUser.id
                                    ? 'float-right'
                                    : 'float-left'
                            "
                        >
                            {{
                                message.sender_id === currentUser.id
                                    ? currentUser.name
                                    : user.name
                            }}
                        </span>
                        <span
                            class="direct-chat-timestamp"
                            :class="
                                message.sender_id === currentUser.id
                                    ? 'float-left'
                                    : 'float-right'
                            "
                        >
                            {{ formatTime(message.created_at) }}
                        </span>
                    </div>
                    <img
                        class="direct-chat-img"
                        :src="
                            message.sender_id === currentUser.id
                                ? '/storage/users_avatar/' + currentUser.avatar
                                : '/storage/users_avatar/' + user.avatar
                        "
                        :alt="
                            message.sender_id === currentUser.id
                                ? currentUser.name
                                : user.name
                        "
                    />
                    <div class="direct-chat-text">
                        {{ message.text }}
                        <span
                            v-if="message.is_delivered && message.is_read"
                            class="bifa albastra float-right"
                        >
                            <img
                                :src="doubleticksvgblue"
                                alt="Read"
                                width="24"
                                height="24"
                            />
                        </span>
                        <span
                            v-if="message.is_delivered && !message.is_read"
                            class="bifa gri float-right"
                        >
                            <img
                                :src="doubleticksvggrey"
                                alt="Delivered"
                                width="24"
                                height="24"
                            />
                        </span>
                        <span
                            v-if="!message.is_delivered"
                            class="bifa gri float-right"
                        >
                            <img
                                :src="ticksvggrey"
                                alt="Sent"
                                width="24"
                                height="24"
                            />
                        </span>
                    </div>
                </div>
            </div>
            <!--/.direct-chat-messages-->
            <!-- Contacts are loaded here -->
            <div class="direct-chat-contacts">
                <ul class="contacts-list">
                    <li v-for="user in users" :key="user.id">
                        <a :href="`/chat/${user.id}`">
                            <img
                                class="contacts-list-img"
                                :src="'/storage/users_avatar/' + user.avatar"
                            />
                            <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                    {{ user.name }}
                                    <small
                                        class="contacts-list-date float-right"
                                    >
                                        <!-- {{ formatTime(user.last_active) }} -->
                                    </small>
                                </span>
                                <span class="contacts-list-msg">
                                    <!-- {{
                                        user.messages_sender
                                            ? user.messages_sender[
                                                  user.messages_sender.length -
                                                      1
                                              ].text
                                            : "No messages yet"
                                    }} -->
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <form @submit.prevent="sendMessage">
                <div class="input-group">
                    <input
                        v-model="newMessage"
                        @keydown="sendTypingEvent"
                        type="text"
                        class="flex-1 border p-3 rounded-lg"
                        placeholder="Type your message here..."
                        style="color: black"
                    />
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            <span class="ml-2">Send</span>
                        </button>
                    </span>
                </div>
            </form>
            <small v-if="isUserTyping" class="text-white mt-5">
                {{ user.name }} is typing...
            </small>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
</template>
<script setup>
import { ref, onMounted, watch, nextTick } from "vue";
import axios from "axios";
import doubleticksvgblue from "@/components/svg/double-tick-svg-blue.svg";
import doubleticksvggrey from "@/components/svg/double-tick-svg-grey.svg";
import ticksvggrey from "@/components/svg/tick-svg-grey.svg";

const users = ref([]);
// Funcția pentru obținerea listei de utilizatori cu ultimul mesaj
const fetchUsers = async () => {
    try {
        const response = await axios.get("/users");
        users.value = response.data;
    } catch (error) {
        console.error("Failed to fetch users:", error);
    }
};
// Apelăm funcția `fetchUsers` la montarea componentei
onMounted(() => {
    fetchUsers();
});
const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    currentUser: {
        type: Object,
        required: true,
    },
});

const messages = ref([]);
const newMessage = ref("");
const messageContainer = ref(null);
const isUserTyping = ref(false);
const isUserTypingTimer = ref(null);
const isUserOnline = ref(false);

watch(
    messages,
    () => {
        nextTick(() => {
            messageContainer.value.scrollTo({
                top: messageContainer.value.scrollHeight,
                behavior: "smooth",
            });
        });
    },
    { deep: true }
);

const fetchMessages = async () => {
    try {
        const response = await axios.get(`/messages/${props.user.id}`);
        messages.value = response.data;
        messages.value.forEach(async (message) => {
            if (
                !message.is_read &&
                message.receiver_id === props.currentUser.id
            ) {
                await markAsRead(message.id);
            }
        });
    } catch (error) {
        console.error("Failed to fetch messages:", error);
    }
};

const sendMessage = async () => {
    if (newMessage.value.trim() !== "") {
        try {
            // Trimiterea mesajului către backend
            const response = await axios.post(`/messages/${props.user.id}`, {
                message: newMessage.value,
            });

            // Adăugarea mesajului trimis în lista de mesaje
            messages.value.push(response.data);
            newMessage.value = "";

            // Verificăm dacă utilizatorul este online
            if (isUserOnline.value) {
                // Dacă este online, mesajul este livrat și citit
                await markAsDelivered(response.data.id);
                await markAsRead(response.data.id);
            } else {
                // Dacă nu este online, doar marcăm mesajul ca livrat
                await markAsDelivered(response.data.id);
            }
        } catch (error) {
            console.error("Failed to send message:", error);
        }
    }
};

// Funcția pentru a marca mesajul ca livrat
const markAsDelivered = async (messageId) => {
    try {
        await axios.post(`/messages/${messageId}/mark-delivered`);
    } catch (error) {
        console.error("Failed to mark message as delivered:", error);
    }
};

// Funcția pentru a marca mesajul ca citit
const markAsRead = async (messageId) => {
    try {
        await axios.post(`/messages/${messageId}/mark-read`);
    } catch (error) {
        console.error("Failed to mark message as read:", error);
    }
};

const sendTypingEvent = () => {
    Echo.private(`chat.${props.user.id}`).whisper("typing", {
        userID: props.currentUser.id,
    });
};

const formatTime = (datetime) => {
    const options = { hour: "2-digit", minute: "2-digit" };
    return new Date(datetime).toLocaleTimeString([], options);
};

onMounted(() => {
    fetchMessages();
    Echo.join(`presence.chat`)
        .here((users) => {
            isUserOnline.value = users.some(
                (user) => user.id === props.user.id
            );
            if (isUserOnline.value) {
                // Dacă utilizatorul este online, marcăm toate mesajele necitite ca citite
                markUnreadMessagesAsRead();
            }
        })
        .joining((user) => {
            if (user.id === props.user.id) {
                isUserOnline.value = true;
                // Când utilizatorul devine online, marcăm mesajele necitite ca citite
                markUnreadMessagesAsRead();
            }
        })
        .leaving((user) => {
            if (user.id === props.user.id) {
                isUserOnline.value = false;
            }
        });

    // Funcția pentru a marca toate mesajele necitite ca citite
    const markUnreadMessagesAsRead = async () => {
        const unreadMessages = messages.value.filter(
            (msg) => !msg.is_read && msg.receiver_id === props.user.id
        );
        for (const msg of unreadMessages) {
            await markAsRead(msg.id);
        }
    };
    Echo.private(`chat.${props.currentUser.id}`)
        .listen("MessageSent", (response) => {
            if (
                response.message.receiver_id === props.user.id ||
                response.message.sender_id === props.user.id
            ) {
                messages.value.push(response.message);
            }
        })
        .listenForWhisper("typing", (response) => {
            isUserTyping.value = response.userID === props.user.id;
            if (isUserTypingTimer.value) {
                clearTimeout(isUserTypingTimer.value);
            }
            isUserTypingTimer.value = setTimeout(() => {
                isUserTyping.value = false;
            }, 1000);
        });
    Echo.private(`chat.${props.currentUser.id}`)
        .listen("MessageDelivered", (response) => {
            const index = messages.value.findIndex(
                (msg) => msg.id === response.message.id
            );
            if (
                response.message.receiver_id === props.user.id ||
                response.message.sender_id === props.user.id
            ) {
                if (index !== -1) {
                    messages.value[index].is_delivered = true;
                }
            }
        })
        .listen("MessageRead", (response) => {
            const index = messages.value.findIndex(
                (msg) => msg.id === response.message.id
            );
            if (
                response.message.receiver_id === props.user.id ||
                response.message.sender_id === props.user.id
            ) {
                if (index !== -1) {
                    messages.value[index].is_read = true;
                }
            }
        });
});
</script>
