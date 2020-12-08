export default class Errors {
  /**
   * Create a new Errors instance.
   */
  constructor () {
    this.errors = {}
  }
  /**
   * Determine if an errors exists for the given field.
   *
   * @param {string} field
   */
  has (expression, exact = true) {
    if (expression.length > 0) {
      if (exact) {
        expression = new RegExp(`^${expression}$`)
      } else {
        expression = new RegExp(`${expression}`)
      }
      return Object.keys(this.errors).some(key => key.match(expression))
    }
    return null
  }
  /**
   * Determine if we have any errors.
   */
  any () {
    return Object.keys(this.errors).length > 0
  }
  /**
   * Retrieve the error message for a field.
   *
   * @param {string} field
   */
  get (expression, exact = true) {
    if (expression.length > 0) {

      if (exact) {
        expression = new RegExp(`^${expression}$`)
      } else {
        expression = new RegExp(`${expression}`)
      }

      let keys = Object.keys(this.errors).filter(key => key.match(expression))
      if (keys.length > 0) {
        return this.errors[keys[0]]
      }
    }
    return undefined
  }

  getAll (expression, exact = true) {
    if (expression.length > 0) {
      if (exact) {
        expression = new RegExp(`^${expression}$`)
      } else {
        expression = new RegExp(`${expression}`)
      }

      let errors = []
      Object.keys(this.errors).filter(key => key.match(expression)).forEach(key => {
        errors.push(this.errors[key])
      })
      return errors
    }
    return undefined
  }

  set (field, error) {
    if (field) {
      this.errors = { ...this.errors, [field]: error }
    }
  }

  /**
   * Record the new errors.
   *
   * @param {object} errors
   */
  record (errors, prefix) {
    let auxErrors = JSON.parse(JSON.stringify(errors))

    for (const key in auxErrors) {
      if (auxErrors.hasOwnProperty(key)) {
        let formatedError = prefix + auxErrors[key][0].toLowerCase().replace('.', '_').replace(/ /g, '_')
        auxErrors[key] = formatedError.substring(0, formatedError.length - 1)
      }
    }
    this.errors = auxErrors
  }

  /**
   * Clear one or all error fields.
   *
   * @param {string|null} field
   */
  clear (field) {
    if (field) {
      delete this.errors[field]
      return
    }
    this.errors = {}
  }
  clearMultiple (fields) {
    fields.forEach(field => this.clear(field))
  }

  nestedErrors (prefix) {
    let errorBag = new StandardErrors()
    Object.entries(this.errors).forEach(([key, value]) => {
      if (key.startsWith(prefix)) {
        let newKey = key.substring(key.indexOf(prefix) + prefix.length)
        errorBag.set(newKey, value)
      }
    })

    return errorBag
  }

  rootErrors () {
    let errorBag = new StandardErrors()

    Object.entries(this.errors).forEach(([key, value]) => {
      if (!key.includes('.')) {
        errorBag.set(key, value)
      }
    })

    return errorBag
  }
}