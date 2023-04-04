import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static targets = [ "modal" ]

  get modal() {
    return this.modalTarget
  }
}
