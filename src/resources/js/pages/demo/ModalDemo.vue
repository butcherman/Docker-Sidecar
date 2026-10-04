<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import Modal from "@/core/components/Modal.vue";
import { ref } from "vue";

const exampleModal = ref(false);

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
        property: "hideBackdrop",
        type: "boolean",
        default: "false",
        required: false,
        description: "When true, there will be no visible backdrop",
    },
    {
        property: "hideClose",
        type: "boolean",
        default: "false",
        required: false,
        description: 'When true, the "close" button will not be shown',
    },
    {
        property: "position",
        type: "'top' | 'bottom' | 'center'",
        default: "center",
        required: false,
        description:
            "Where to place the Modal.  Top, bottom or center of screen",
    },
    {
        property: "preventOutsideClick",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "When true, the modal will not close when the backdrop is clicked, forcing user to interact with the Modal",
    },
    {
        property: "size",
        type: "ComponentSize",
        default: "md",
        required: false,
        description: "Width of the Modal",
    },
    {
        property: "title",
        type: "string",
        default: "",
        required: false,
        description:
            "Places a bordered header at the top of the Modal with the given text.",
    },
];
const slotProperties = [
    {
        name: "default",
        params: "",
        description: "Content within the drawer",
    },
    {
        name: "header",
        params: "",
        description: "Content for the bordered header at the top of the Modal",
    },
    {
        name: "footer",
        params: "",
        description:
            "Content for the bordered footer at the bottom of the Modal",
    },
];

const emitProperties = [
    {
        name: "hidePrevented",
        params: "",
        description:
            "Triggered when preventOutsideClick prop is enabled and user tries to click outside of Modal to close",
    },
    {
        name: "hide",
        params: "",
        description: "Triggered before the Modal closes",
    },
    {
        name: "hidden",
        params: "",
        description: "Triggered after the Modal has closed",
    },
    {
        name: "show",
        params: "",
        description: "Triggered before the Modal opens",
    },
    {
        name: "shown",
        params: "",
        description: "Triggered after the Modal has opened",
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
                Box that pops up on top of the page and blocks all interaction
                with the rest of the page.
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <div class="flex justify-center">
                    <BaseButton
                        text="Show Modal"
                        @click="exampleModal = true"
                    />
                    <Modal v-model="exampleModal" title="Example Modal">
                        lorem ipsum dolor sit amet consectetur adipiscing elit
                        omnis et et accusamus pariatur vero qui aliquip dolor
                        velit et distinctio cumque libero facere ea quas
                        mollitia non deserunt sint blanditiis est quidem dolores
                        optio nostrud tempor officia elit atque aliqua corrupti
                        maxime do ducimus dolore commodo cumque et laborum est
                    </Modal>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Modal from "@/core/components/Modal.vue"
                <br />
                <br />
                &emsp;const showModal = ref(false);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Modal v-model="showModal" title="Example
                Modal"&gt;<br />
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
                &emsp;&lt;/Modal&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
