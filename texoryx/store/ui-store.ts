import { create } from "zustand";

type UiState = {
  quickAddOpen: boolean;
  selectedProductionStage: "READY" | "RUNNING" | "QC" | "COMPLETED";
  setQuickAddOpen: (open: boolean) => void;
  setSelectedProductionStage: (stage: UiState["selectedProductionStage"]) => void;
};

export const useUiStore = create<UiState>((set) => ({
  quickAddOpen: false,
  selectedProductionStage: "READY",
  setQuickAddOpen: (quickAddOpen) => set({ quickAddOpen }),
  setSelectedProductionStage: (selectedProductionStage) => set({ selectedProductionStage })
}));
