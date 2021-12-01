export { default as UiAddress } from '../..\\client\\components\\ui-address.vue'
export { default as UiAuthLogin } from '../..\\client\\components\\ui-auth-login.vue'
export { default as UiAuthPassword } from '../..\\client\\components\\ui-auth-password.vue'
export { default as UiAuthRegister } from '../..\\client\\components\\ui-auth-register.vue'
export { default as UiDropdown } from '../..\\client\\components\\ui-dropdown.vue'
export { default as UiField } from '../..\\client\\components\\ui-field.vue'
export { default as UiFile } from '../..\\client\\components\\ui-file.vue'
export { default as UiForm } from '../..\\client\\components\\ui-form.vue'
export { default as UiModal } from '../..\\client\\components\\ui-modal.vue'
export { default as UiNav } from '../..\\client\\components\\ui-nav.vue'
export { default as UiPassword } from '../..\\client\\components\\ui-password.vue'
export { default as UiPlayground } from '../..\\client\\components\\ui-playground.vue'
export { default as UiSearch } from '../..\\client\\components\\ui-search.vue'
export { default as UiSidebar } from '../..\\client\\components\\ui-sidebar.vue'
export { default as UiUpload } from '../..\\client\\components\\ui-upload.vue'
export { default as UiContent } from '../..\\client\\components\\ui-content\\index.vue'
export { default as UiContentStyle } from '../..\\client\\components\\ui-content\\style.vue'
export { default as UiEditorCode } from '../..\\client\\components\\ui-editor\\code.vue'
export { default as UiEditorHtml } from '../..\\client\\components\\ui-editor\\html.vue'
export { default as UiEditor } from '../..\\client\\components\\ui-editor\\index.vue'
export { default as UiContentElement } from '../..\\client\\components\\ui-content\\element\\index.js'
export { default as UiContentElementHtmlEditor } from '../..\\client\\components\\ui-content\\element\\html\\editor.vue'
export { default as UiContentElementHtmlInfo } from '../..\\client\\components\\ui-content\\element\\html\\info.js'
export { default as UiContentElementHtmlRender } from '../..\\client\\components\\ui-content\\element\\html\\render.vue'
export { default as UiContentElementPriceEditor } from '../..\\client\\components\\ui-content\\element\\price\\editor.vue'
export { default as UiContentElementPriceInfo } from '../..\\client\\components\\ui-content\\element\\price\\info.js'
export { default as UiContentElementPriceRender } from '../..\\client\\components\\ui-content\\element\\price\\render.vue'

// nuxt/nuxt.js#8607
function wrapFunctional(options) {
  if (!options || !options.functional) {
    return options
  }

  const propKeys = Array.isArray(options.props) ? options.props : Object.keys(options.props || {})

  return {
    render(h) {
      const attrs = {}
      const props = {}

      for (const key in this.$attrs) {
        if (propKeys.includes(key)) {
          props[key] = this.$attrs[key]
        } else {
          attrs[key] = this.$attrs[key]
        }
      }

      return h(options, {
        on: this.$listeners,
        attrs,
        props,
        scopedSlots: this.$scopedSlots,
      }, this.$slots.default)
    }
  }
}
