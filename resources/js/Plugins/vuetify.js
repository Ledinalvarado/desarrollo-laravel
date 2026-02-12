import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { mdi } from 'vuetify/iconsets/mdi'

export default createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        sets: {
            mdi,
        },
    },
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                dark: false,
                colors: {
                    primary: '#22c55e', // Verde principal
                    secondary: '#fbbf24', // Amarillo secundario
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#ffffff',
                    surface: '#ffffff',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#2d3748',
                    'on-surface': '#2d3748',
                    'grey-50': '#f9fafb',
                    'grey-100': '#f3f4f6',
                    'grey-200': '#e5e7eb',
                    'grey-300': '#d1d5db',
                    'grey-400': '#9ca3af',
                    'grey-500': '#6b7280',
                    'grey-600': '#4b5563',
                    'grey-700': '#374151',
                    'grey-800': '#1f2937',
                    'grey-900': '#111827',
                }
            },
            dark: {
                dark: true,
                colors: {
                    primary: '#22c55e',
                    secondary: '#fbbf24',
                    accent: '#22c55e',
                    error: '#ef4444',
                    info: '#3b82f6',
                    success: '#10b981',
                    warning: '#f59e0b',
                    background: '#1f2937',
                    surface: '#374151',
                    'on-primary': '#ffffff',
                    'on-secondary': '#1f2937',
                    'on-background': '#f9fafb',
                    'on-surface': '#f9fafb',
                }
            }
        }
    }
})
