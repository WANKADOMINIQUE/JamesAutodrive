<template>
  <div class="card-preview-wrap">
    <div class="card-preview" :class="{ flipped: showBack }">
      <!-- Front -->
      <div class="card-face card-front">
        <div class="card-top">
          <div class="card-chip"></div>
          <div class="card-network">{{ networkLabel }}</div>
        </div>
        <div class="card-number-display">
          <span>{{ displaySegment(0) }}</span>
          <span>{{ displaySegment(1) }}</span>
          <span>{{ displaySegment(2) }}</span>
          <span>{{ displaySegment(3) }}</span>
        </div>
        <div class="card-bottom">
          <div>
            <div class="card-label">Card Holder</div>
            <div class="card-value">{{ holder || 'YOUR NAME' }}</div>
          </div>
          <div>
            <div class="card-label">Expires</div>
            <div class="card-value">{{ expiry || 'MM/YY' }}</div>
          </div>
        </div>
      </div>

      <!-- Back -->
      <div class="card-face card-back">
        <div class="card-strip"></div>
        <div class="card-sig-row">
          <div class="card-sig-lines">
            <div v-for="i in 5" :key="i" class="sig-line"></div>
          </div>
          <div class="card-cvv-box">
            <div class="card-label" style="color:#888;font-size:9px;">CVV</div>
            <div class="card-cvv-val">{{ cvvDisplay }}</div>
          </div>
        </div>
        <div class="card-back-logo">{{ networkLabel }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  cardNumber: { type: String, default: '' },
  holder:     { type: String, default: '' },
  expiry:     { type: String, default: '' },
  cvv:        { type: String, default: '' },
  showBack:   { type: Boolean, default: false },
})

const raw = computed(() => props.cardNumber.replace(/\s/g, '').padEnd(16, '•'))

function displaySegment(index) {
  return raw.value.slice(index * 4, index * 4 + 4)
}

const cvvDisplay = computed(() => props.cvv ? '•'.repeat(props.cvv.length) : '•••')

const networkLabel = computed(() => {
  const n = props.cardNumber.replace(/\s/g, '')
  if (/^4/.test(n))      return 'VISA'
  if (/^5[1-5]/.test(n)) return 'MASTERCARD'
  if (/^3[47]/.test(n))  return 'AMEX'
  if (/^6/.test(n))      return 'MAESTRO'
  return 'CARD'
})
</script>

<style scoped>
.card-preview-wrap {
  padding: 0 24px 24px;
  perspective: 1200px;
}

.card-preview {
  position: relative;
  height: 190px;
  transform-style: preserve-3d;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-preview.flipped {
  transform: rotateY(180deg);
}

.card-face {
  position: absolute;
  inset: 0;
  border-radius: 16px;
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(212,160,23,0.15);
}

/* Front */
.card-front {
  background: linear-gradient(135deg, #1e1e32 0%, #2a2a44 50%, #1a1a2e 100%);
  border: 1px solid rgba(212,160,23,0.25);
  padding: 22px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}

.card-front::before {
  content: '';
  position: absolute;
  top: -50px; right: -50px;
  width: 200px; height: 200px;
  background: radial-gradient(circle, rgba(212,160,23,0.12) 0%, transparent 70%);
  pointer-events: none;
}

.card-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.card-chip {
  width: 36px; height: 28px;
  background: linear-gradient(135deg, #d4a017 0%, #f0c040 100%);
  border-radius: 5px;
  position: relative;
}
.card-chip::before {
  content: '';
  position: absolute;
  top: 50%; left: 0; right: 0;
  height: 1px;
  background: rgba(0,0,0,0.25);
  transform: translateY(-50%);
}
.card-chip::after {
  content: '';
  position: absolute;
  left: 50%; top: 0; bottom: 0;
  width: 1px;
  background: rgba(0,0,0,0.25);
  transform: translateX(-50%);
}

.card-network {
  font-size: 16px;
  font-weight: 800;
  font-style: italic;
  color: rgba(255,255,255,0.85);
  letter-spacing: -0.5px;
}

.card-number-display {
  display: flex;
  gap: 12px;
  font-size: 17px;
  font-weight: 300;
  letter-spacing: 0.15em;
  color: #fff;
  font-variant-numeric: tabular-nums;
}

.card-bottom {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}

.card-label {
  font-size: 9px;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.4);
  margin-bottom: 3px;
}

.card-value {
  font-size: 13px;
  font-weight: 500;
  color: rgba(255,255,255,0.9);
  letter-spacing: 0.04em;
  text-transform: uppercase;
  max-width: 160px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Back */
.card-back {
  background: linear-gradient(135deg, #16162a 0%, #1e1e30 100%);
  border: 1px solid rgba(212,160,23,0.15);
  transform: rotateY(180deg);
  overflow: hidden;
}

.card-strip {
  width: 100%;
  height: 44px;
  background: #111;
  margin-top: 28px;
}

.card-sig-row {
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 14px 22px 0;
}

.card-sig-lines {
  flex: 1;
  background: #e8e8e8;
  border-radius: 4px;
  padding: 8px 10px;
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.sig-line {
  height: 2px;
  background: repeating-linear-gradient(90deg, #ccc 0px, #ccc 4px, transparent 4px, transparent 8px);
}

.card-cvv-box {
  background: #fff;
  border-radius: 4px;
  padding: 6px 12px;
  text-align: center;
  min-width: 50px;
}

.card-cvv-val {
  font-size: 13px;
  font-weight: 700;
  color: #1a1a26;
  letter-spacing: 0.12em;
}

.card-back-logo {
  position: absolute;
  bottom: 14px;
  right: 22px;
  font-size: 14px;
  font-weight: 800;
  font-style: italic;
  color: rgba(255,255,255,0.4);
}
</style>
