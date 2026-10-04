<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import okModal from "@/core/features/okModal";
import verifyModal from "@/core/features/verifyModal";
import { ref } from "vue";

const verifyRes = ref();
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Callable functions for alerting or verifing operations.
            </p>
        </Card>
        <ExampleComponent title="Verify Prompt Demo">
            <template #component>
                <div class="flex flex-col gap-2 items-center">
                    <BaseButton
                        text="Click for Verify Modal"
                        @click="
                            verifyModal('Verify Message', 'Verify Title').then(
                                (res) => (verifyRes = res ? 'Yes' : 'No'),
                            )
                        "
                    />
                    <div v-if="verifyRes">You clicked {{ verifyRes }}</div>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import verifyModal from "@/core/features/verifyModal";<br />
                <br />
                &emsp;const verifyThis = () => {<br />
                &emsp;&emsp;verifyModal('Verify Message', 'Verify
                Title').then(res => {<br />
                &emsp;&emsp;&emsp;if(res) {<br />
                &emsp;&emsp;&emsp;&emsp;alert('Yes Clicked');<br />
                &emsp;&emsp;&emsp;} else {<br />
                &emsp;&emsp;&emsp;&emsp;alert('No Clicked');<br />
                &emsp;&emsp;&emsp;}<br />
                &emsp;&emsp;})<br />
                &emsp;}<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Button<br />
                &emsp;&emsp;title="Click for Verify Modal"<br />
                &emsp;&emsp;@click="verifyThis"<br />
                &emsp;&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="OK Prompt Demo">
            <template #component>
                <div class="text-center">
                    <BaseButton
                        text="Click for OK Modal"
                        @click="okModal('OK Message')"
                    />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import okModal from "@/core/features/okModal";<br />
                <br />
                &emsp;const showOk = () => {<br />
                &emsp;&emsp;okModal('Ok Message', 'Verify Title')<br />
                &emsp;}<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Button<br />
                &emsp;&emsp;title="Click for OK Modal"<br />
                &emsp;&emsp;@click="showOk"<br />
                &emsp;&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
    </div>
</template>
