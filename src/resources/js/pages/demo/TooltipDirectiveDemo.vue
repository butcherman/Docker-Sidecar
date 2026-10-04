<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Directive for displaying a notification pop-up with the hovered
                component.
            </p>
        </Card>
        <ExampleComponent show>
            <template #component>
                <p class="text-center mb-3">
                    Hover over the buttons to see the tooltip
                </p>
                <div
                    class="flex flex-col md:flex-row justify-center gap-3 mb-3"
                >
                    <BaseButton text="Default Tooltip" v-tooltip="'On Top'" />
                    <BaseButton text="Top Tooltip" v-tooltip.top="'On Top'" />
                    <BaseButton
                        text="Bottom Tooltip"
                        v-tooltip.bottom="'On Bottom'"
                    />
                    <BaseButton
                        text="Left Tooltip"
                        v-tooltip.left="'On Left'"
                    />
                    <BaseButton
                        text="Right Tooltip"
                        v-tooltip.right="'On Right'"
                    />
                </div>
            </template>
            <template #code>
                &lt;template&gt;<br />
                &emsp;&lt;BaseButton text="Default Tooltip" v-tooltip="'On Top'"
                /&gt;<br />
                &emsp;&lt;BaseButton text="Top Tooltip" v-tooltip.top="'On Top'"
                /&gt;<br />
                &emsp;&lt;BaseButton text="Bottom Tooltip" v-tooltip.bottom="'On
                Bottom'" /&gt;<br />
                &emsp;&lt;BaseButton text="Left Tooltip" v-tooltip.left="'On
                Left'" /&gt;<br />
                &emsp;&lt;BaseButton text="Right Tooltip" v-tooltip.right="'On
                Right'" /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
    </div>
</template>
