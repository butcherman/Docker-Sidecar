<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const copyText = ref("Click the Copy Badge to copy this text to the clipboard");
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p>Directive for copying text data to the clipboard.</p>
        </Card>
        <ExampleComponent title="Directive Example" show>
            <template #component>
                <div class="flex justify-center">
                    <p v-copy="copyText">{{ copyText }}</p>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;const copyText = ref("Click the Copy Badge to copy this
                text to the clipboard"); <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;p v-copy="copyText"&gt;&lbrace;&lbrace; copyText
                &rbrace;&rbrace;&lt;/p&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
    </div>
</template>
