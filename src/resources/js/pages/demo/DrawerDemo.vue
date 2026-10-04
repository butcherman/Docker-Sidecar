<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import Drawer from "@/core/components/Drawer.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const exampleDrawer = ref(false);

const referenceProperties = [
    {
        property: "show",
        type: "boolean",
        default: "",
        required: true,
        description:
            "When true, content will be shown, when false content will be hidden",
    },
    {
        property: "position",
        type: "Placement",
        default: "bottom",
        required: false,
        description: "Where to place the drawer.  Top, bottom, left or right",
    },
    {
        property: "title",
        type: "string",
        default: "",
        required: false,
        description:
            "Places a bordered header at the top of the card with the given text.",
    },
];
const slotProperties = [
    {
        name: "default",
        params: "",
        description: "Content within the drawer",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Collapsable pane that pops up over the top of the main page.
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <div class="text-center">
                    <BaseButton
                        text="Toggle Drawer"
                        @click="exampleDrawer = !exampleDrawer"
                    />
                </div>
                <Drawer v-model="exampleDrawer" title="Example Drawer">
                    lorem ipsum dolor sit amet consectetur adipiscing elit omnis
                    et et accusamus pariatur vero qui aliquip dolor velit et
                    distinctio cumque libero facere ea quas mollitia non
                    deserunt sint blanditiis est quidem dolores optio nostrud
                    tempor officia elit atque aliqua corrupti maxime do ducimus
                    dolore commodo cumque et laborum est
                </Drawer>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Drawer from "@/core/components/Drawer.vue"
                <br />
                <br />
                &emsp;const showDrawer = ref(false);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Drawer v-model="showDrawer" title="Example
                Drawer"&gt;<br />
                &emsp;&emsp;&lt;div&gt;
                <div class="ms-12">
                    lorem ipsum dolor sit amet consectetur adipiscing elit omnis
                    et et accusamus pariatur vero qui aliquip dolor velit et
                    distinctio cumque libero facere ea quas mollitia non
                    deserunt sint blanditiis est quidem dolores optio nostrud
                    tempor officia elit atque aliqua corrupti maxime do ducimus
                    dolore commodo cumque et
                </div>
                &emsp;&emsp;&lt;/div&gt; <br />
                &emsp;&lt;/Drawer&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
